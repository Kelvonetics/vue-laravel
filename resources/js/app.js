
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import VueRouter from 'vue-router'
import Routes from './route'
import {alert} from 'vue-strap'

require('./bootstrap');



window.Vue = require('vue');

Vue.use (VueRouter);

const router = new VueRouter({
	routes: Routes
});



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('articles', require('./components/Articles.vue').default);
Vue.component('users', require('./components/Users.vue').default);
Vue.component('sidebar', require('./components/sidebar.vue').default);
Vue.component('content-wrapper', require('./components/Content-wrapper.vue').default);
Vue.component('cards', require('./components/Cards.vue').default);
Vue.component('foot', require('./components/Foot.vue').default);
Vue.component('products', require('./components/Products.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue(
{
    el: '#app',
    router: router,
    components: {alert}
});


