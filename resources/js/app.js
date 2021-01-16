import Vue from 'vue';
//import VueRouter from 'vue-router';
//import routes from './routes/routes';

window.Vue = Vue;

import Modal from './plugins/modal/ModalPlugin';

Vue.use(Modal);

import axios from  'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Komponenten shared
import LigaLiveTicker from './components/shared/LigaLiveTicker';
import SmoothScroll from './components/shared/SmoothScroll';
import MainNavigation from './components/shared/MainNavigation';
import ConditionalVisible from './components/shared/ConditionalVisible';

Vue.component('ligaliveticker', LigaLiveTicker);
Vue.component('smoothscroll', SmoothScroll);
Vue.component('conditionalvisible', ConditionalVisible);
Vue.component('mainnavigation', MainNavigation);

//Vue.use(VueRouter);

import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
});

let app = new Vue({
    el: '#app',
    //router: new VueRouter(routes)
});
