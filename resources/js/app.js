
require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
import { Form, HasError, AlertError } from 'vform'
Vue.use(VueRouter)


Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

window.Form = Form;
const routes = [
    { path: '/teachers', component: require('./components/Teachers.vue').default },
  ]



const router = new VueRouter({
    mode: 'history',
    routes
  })

Vue.component('teachers', require('./components/Teachers.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
