
require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import 'materialize-css/dist/css/materialize.css'
import 'materialize-css/dist/js/materialize.min'

import VAppMain from './App.vue'
import router from './route/'

Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    components: { VAppMain },
    // template: '<App/>',
    router
});
