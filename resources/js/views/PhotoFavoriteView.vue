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

    <div class="flex justify-between">
      <button class="px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:cursor-pointer transition duration-150 ease-in-out"
              @click="previous"
      >
        Previous Page
      </button>
      <button class="px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 hover:cursor-pointer transition duration-150 ease-in-out"
              @click="next"
      >
        Next Page
      </button>
    </div>
  </div>
</template>

<script>
import FavStart from "../components/FavStart.vue";

export default {
  name: 'PhotoFavoriteView',
  components: {FavStart},

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
      if (!this.hasNextPage()) return;

      this.start += this.perPage;

      this.fetchPhotos();
    },

    hasNextPage() {
      return this.start + this.perPage < this.totalPhotos;
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

      axios.post('/favorites/toggle', body)
          .then(res => console.log(res));
    }
  }
}
</script>
