import './bootstrap';

import Alpine from 'alpinejs';

import { createApp } from 'vue';
import PhotoFavoriteView from "./views/PhotoFavoriteView.vue";

window.Alpine = Alpine;

Alpine.start();

createApp({})
  .component('PhotoFavoriteView', PhotoFavoriteView)
  .mount('#app')
