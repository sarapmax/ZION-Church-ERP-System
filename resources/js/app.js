
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

// Add a request interceptor.
axios.interceptors.request.use(function (config) {
    $('.page-loading-spinner').css('display', 'block')

    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});

// Add a response interceptor
axios.interceptors.response.use(function (response) {
    $('.page-loading-spinner').css('display', 'none')

    return response;
}, function (error) {
    $('.page-loading-spinner').css('display', 'none')
    return Promise.reject(error);
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Geolocation from './components/Geolocation.vue';
import ChurchStructureSelection from './components/ChurchStructureSelection.vue'

Vue.component('geolocation', Geolocation);
Vue.component('church-structure-selection', ChurchStructureSelection);

// Pages
import UserForm from './pages/membership/user/UserForm.vue';

Vue.component('user-form', UserForm)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
