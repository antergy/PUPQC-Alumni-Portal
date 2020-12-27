
require('./bootstrap');
window.Vue = require('vue');
Vue.component('test', require('./components/test_component').default);

const app = new Vue({
    el: '#app'
});
