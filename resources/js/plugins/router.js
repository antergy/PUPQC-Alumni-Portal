import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '../components/page/Login/Login.vue';
import Home from '../components/page/Home/Home.vue';
import Profile from '../components/page/Profile/Profile.vue';
import Registration from '../components/page/Public/Registration/Registration.vue';
import TracerIntro from "../components/page/Public/TracerIntro/TracerIntro.vue";
import TracerFormMS from "../components/page/Public/Forms/MSIT_PROTO/MSIT_proto.vue";
import TracerForm from "../components/page/Public/Forms/TracerForm.vue";
import AdminMgt from "../components/page/Admin/AccountMgt.vue";
import TracerFormMgt from "../components/page/Admin/TracerFormMgt.vue";
import SysConfigAccEntities from "../components/page/Admin/SysConfig/AccountEntities.vue";
import SysConfigSysEntities from "../components/page/Admin/SysConfig/SystemEntities.vue";
import FormEntities_Basic from "../components/page/Admin/SysConfig/FormEntities/FormEntities_Basic.vue";
import FormEntities_Questions from "../components/page/Admin/SysConfig/FormEntities/FormEntities_Questions.vue";
import AnsweredTracerForm from "../components/page/Public/Forms/AnsweredTracerForm/AnsweredTracerForm";

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
                path: '/tracerForm/:id',
                name: 'TracerForm',
                component: TracerForm
            },
            {
                path: '/tracerForm/answer/:id',
                name: 'AnsweredTracerForm',
                component: AnsweredTracerForm
            },
            {
                path: '/ms_tracerForm',
                name: 'TracerFormMS',
                component: TracerFormMS
            },
            {
                path: '/admin/accounts',
                name: 'AdminMgt',
                component: AdminMgt
            },
            {
                path: '/admin/tracerForm',
                name: 'TracerFormMgt',
                component: TracerFormMgt
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
            },
            {
                path: '/admin/sysconfig/form/basic',
                name: 'FormEntities_Basic',
                component: FormEntities_Basic
            },
            {
                path: '/admin/sysconfig/form/questions',
                name: 'FormEntities_Questions',
                component: FormEntities_Questions
            }
        ]
    })
}
