/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


import Devotions from './views/devotions/Devotions'
import Page1 from './views/devotions/Page1'
import DevotionsDetail from './views/devotions/DevotionsDetail'

const router = new VueRouter({
    // base: '/new_thi/public/devotions',
    mode: 'history',
    routes: [{
        path:'/calendar-plan',
        name: 'home',
        component: Devotions
    },{
        path: '/reading-plan',
        name: 'page-1',
        component: Page1
    }, {
        path: '/read/:permalink',
        name: 'devotionRead',
        component: DevotionsDetail
    }]
});

Vue.component('navbar', require('./components/Navbar').default);
Vue.component('footbar', require('./components/Footer').default);
Vue.component('language-switcher', require('./components/LanguageSwitcher').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
