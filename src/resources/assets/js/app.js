
require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import App from './App.vue'
import router from './route/'

Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    components: { App },
    template: '<App/>',
    router
});
