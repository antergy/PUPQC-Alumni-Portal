
require('./bootstrap');

import Vue from 'vue'
import vueRouter from './plugins/router'
import vuetify from './plugins/vuetify'
import './components/index'

const app = new Vue({
    el: '#app',
    vuetify,
    router: vueRouter.router
});
