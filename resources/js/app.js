
require('./bootstrap');

import Vue from 'vue'
import vueRouter from './plugins/router'
import uiKit from './plugins/uiKit'
import './plugins/fontawesome'
import "tailwindcss/tailwind.css"

const app = new Vue({
    el: '#app',
    router: vueRouter.router,
    mounted () {
        uiKit()
    }
});
