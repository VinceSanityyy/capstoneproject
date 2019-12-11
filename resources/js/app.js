
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
    { path: '/rooms', component: require('./components/Rooms.vue').default },
    { path: '/addteacher', component: require('./components/AddTeacher.vue').default },
    { path: '/departments', component: require('./components/Departments.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/subjects', component: require('./components/Subjects.vue').default },
    { path: '/schedules', component: require('./components/Schedules.vue').default },
    { path: '/attendanceReport', component: require('./components/Attendance.vue').default },
    { path: '/viewTeacher', name: 'EDITTEACHER', component: require('./components/EditTeacher.vue').default },
    
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
