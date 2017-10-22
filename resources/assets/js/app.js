
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

Vue.component('input-text', require('./components/InputText.vue'));

const app = new Vue({
    el: '#app'
});

/*  yarn add flatpickr -- flatpickr no need to import css if use default */
// require("flatpickr/dist/themes/dark.css");
// window.flatpickr = require("flatpickr"); // const flatpickr = require("flatpickr");
flatpickr('#tryme');
autosize(document.querySelectorAll('textarea'));

