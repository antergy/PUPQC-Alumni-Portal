import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '../components/page/Login/Login.vue';
import Home from '../components/page/Home/Home.vue';
import Profile from '../components/page/Profile/Profile.vue';
import Registration from '../components/page/Public/Registration/Registration.vue';
import TracerIntro from "../components/page/Public/TracerIntro/TracerIntro.vue";
import TracerForm from "../components/page/Public/Forms/MSIT_PROTO/MSIT_proto.vue";

Vue.use(VueRouter);

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
            },
            {
                path: '/profile',
                name: 'Profile',
                component: Profile
            },
            {
                path: '/register',
                name: 'Registration',
                component: Registration
            },
            {
                path: '/tracerIntro',
                name: 'TracerIntro',
                component: TracerIntro
            },
            {
                path: '/tracerForm',
                name: 'TracerForm',
                component: TracerForm
            }
        ]
    })
}
