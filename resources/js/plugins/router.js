import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../components/page/Login/Login.vue'
import Home from '../components/page/Home/Home.vue'

Vue.component('Login', Login)
Vue.use(VueRouter)

export default {
    router: new VueRouter({
        mode: 'history',
        routes: [
            {
                path: '/',
                name: 'Login',
                component: Login
            },
            {
                path: '/home',
                name: 'Home',
                component: Home
            }
        ]
    })
}
