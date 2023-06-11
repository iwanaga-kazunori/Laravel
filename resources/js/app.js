/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
import Slick from 'vue-slick';
import axios from 'axios';

import VModal from 'vue-js-modal';
Vue.use(VModal);
import Spinner from 'vue-simple-spinner';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('matches-component', require('./components/MatchesComponent.vue').default);
// Vue.component('hooper-component', require('./components/HooperComponent.vue').default);
// Vue.component('modal-component', require('./components/ModalComponent.vue').default);
Vue.component('User', require('./components/User.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
      checkflg : false,
    },
    components: {
        Spinner,
      },
});