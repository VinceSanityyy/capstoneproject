
require('./bootstrap');

window.Vue = require('vue');
Vue.prototype.$toast = toast
import Vue from 'vue'
import VueRouter from 'vue-router'
import { Form, HasError, AlertError } from 'vform'
import swal from 'sweetalert2'

import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
import Datepicker from 'vuejs-datepicker';


import Graph from './components/Graph.vue'
import VueFusionCharts from 'vue-fusioncharts';
import FusionCharts from 'fusioncharts';

Vue.component('pagination', require('laravel-vue-pagination'));


Vue.use(datePicker);
Vue.use(VueRouter)
Vue.use(VueFusionCharts, FusionCharts);


Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)



window.swal = swal;
window.Form = Form;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  width: 300,
  timer: 3000
});

window.toast = toast;

const routes = [
    { path: '/teachers', component: require('./components/Teachers.vue').default },
    { path: '/rooms', component: require('./components/Rooms.vue').default },
    { path: '/addteacher', component: require('./components/AddTeacher.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/subjects', component: require('./components/Subjects.vue').default },
    { path: '/subjectcodes', component: require('./components/SubjectCodes.vue').default },
    { path: '/schedules', component: require('./components/Schedules.vue').default },
    { path: '/addSchedules', component: require('./components/AddSchedule.vue').default },
    { path: '/attendanceReport', component: require('./components/Attendance.vue').default },
    { path: '/viewTeacher', name: 'EDITTEACHER', component: require('./components/EditTeacher.vue').default },
    { path: '/firstRound', name: 'editFirst', component: require('./components/FirstRound.vue').default },
    { path: '/secondRound', name: 'editSecond', component: require('./components/SecondRound.vue').default },
    { path: '/checkers', name: 'getCheckers', component: require('./components/AttendanceCheck.vue').default },
    { path: '/teacherRecords', name: 'getTeacherRecords', component: require('./components/teacherRecord.vue').default },
    { path: '/comments', component: require('./components/Comments.vue').default },
  ]



const router = new VueRouter({
    mode: 'history',
    routes
  })

Vue.component('teachers', require('./components/Teachers.vue').default);
Vue.component('graph', require('./components/Graph.vue').default);

const app = new Vue({
    el: '#app',
    router,
    components: {
      datePicker,
      }
});
