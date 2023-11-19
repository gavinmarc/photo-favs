<template>
  <div v-if="photos.length === 0">
    No photos found
  </div>

  <div v-if="photos.length > 0"
       class="mt-8"
  >
    <div class="grid grid-cols-4 gap-4">
      <div v-for="photo in photos"
           @click="toggleFavorite(photo)"
           class="hover:cursor-pointer"
      >
        <img :src="photo.url" :alt="photo.title"/>
        <div class="flex">
          <FavStart class="h-10 w-10" :starred="starredIds.includes(photo.id)"/>
          <label class="ml-1">{{ photo.title }}</label>
        </div>
      </div>
    </div>

    <div class="flex justify-between mt-8">
      <Button @click="previous" :disabled="start <= 0">
        Previous Page
      </Button>
      <Button @click="next" :disabled="!hasNextPage">
        Next Page
      </Button>
    </div>
  </div>
</template>

<script>
import FavStart from "../components/FavStart.vue";
import Button from "../components/Button.vue";

export default {
  name: 'PhotoFavoriteView',
  components: {Button, FavStart},

  props: ['initialIds'],

  data() {
    return {
      start: 0,
      perPage: 12,
      totalPhotos: 5000,
      photos: [],
      starredIds: []
    }
  },

  mounted() {
    this.starredIds = this.initialIds;

    this.fetchPhotos();
  },

  computed: {
    hasNextPage() {
      return this.start + this.perPage < this.totalPhotos;
    },
  },

  methods: {
    fetchPhotos() {
      const url = 'https://jsonplaceholder.typicode.com/photos?'
          + `_start=${this.start}&_limit=${this.perPage}`;

      axios.get(url)
          .then((res) => this.photos = res.data);
    },

    previous() {
      if (this.start <= 0) return;

      this.start -= this.perPage;

      this.fetchPhotos();
    },

    next() {
      if (!this.hasNextPage) return;

      this.start += this.perPage;

      this.fetchPhotos();
    },

    toggleFavorite(photo) {
      const index = this.starredIds.indexOf(photo.id);

      // toggle local state
      if (index === -1) {
        this.starredIds.push(photo.id);
      } else {
        this.starredIds.splice(index, 1)
      }

      // persist state
      const body = {
        'photo_id': photo.id,
        'photo_url': photo.url,
      };

      axios.post('/favorites/toggle', body);
    }
  }
}
</script>
