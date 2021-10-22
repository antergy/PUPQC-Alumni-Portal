import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '../components/page/Login/Login.vue';
import Home from '../components/page/Home/Home.vue';
import Profile from '../components/page/Profile/Profile.vue';
import Registration from '../components/page/Public/Registration/Registration.vue';
import TracerIntro from "../components/page/Public/TracerIntro/TracerIntro.vue";
import TracerForm from "../components/page/Public/Forms/MSIT_PROTO/MSIT_proto.vue";
import TracerFormUG from "../components/page/Public/Forms/UG_PROTO/UG_proto.vue";
import AdminMgt from "../components/page/Admin/AccountMgt.vue";
import SysConfigAccEntities from "../components/page/Admin/SysConfig/AccountEntities.vue";
import SysConfigSysEntities from "../components/page/Admin/SysConfig/SystemEntities.vue";

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
            },
            {
                path: '/ug_tracerForm',
                name: 'TracerFormUG',
                component: TracerFormUG
            },
            {
                path: '/admin/accounts',
                name: 'AdminMgt',
                component: AdminMgt
            },
            {
                path: '/admin/sysconfig/acc_entities',
                name: 'SysConfigAccEntities',
                component: SysConfigAccEntities
            },
            {
                path: '/admin/sysconfig/sys_entities',
                name: 'SysConfigSysEntities',
                component: SysConfigSysEntities
            }
        ]
    })
}
