
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Buefy from 'buefy';

//
// import InfiniteLoading from 'vue-infinite-loading';
//
// Vue.use(InfiniteLoading);

Vue.use(Buefy);

Vue.component('postList', require('./components/frontend/postList.vue'));
Vue.component('replyList', require('./components/frontend/replyList.vue'));
Vue.component('categoryTag', require('./components/frontend/categoryTag.vue'));
// Vue.component('createPost', require('./components/frontend/createPost.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
