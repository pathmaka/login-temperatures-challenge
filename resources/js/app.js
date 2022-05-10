/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Router from './routes.js';


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('login', require('./components/LoginComponent.vue').default);
Vue.component('home', require('./components/HomeComponent.vue').default);
Vue.component('register', require('./components/RegisterComponent.vue').default);


const app = new Vue({
    el: '#app',
    router:Router
}); 
