<template>
    <div class="col-xs-12">
        <div class="row">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Add a new Schedule</h3>

                   
                </div>
                <div class="box-body">
                    <form @submit.prevent = createSchedule>
                    <div class="col-xs-6 form-group">
                        <label>Select Teacher</label>
                        <v-select :options="teachers"
                            v-model="form.teacher"
                            :required="!form.teacher"
                            />
                    </div>
                    <div class="col-xs-6 form-group">
                        <label>Subject</label>
                       <v-select :options="subjectcodes"
                            v-model="form.subject"
                            :required="!form.subject"
                            />
                    </div>
                    <div class="col-xs-2 form-group">
                        <label>Room</label>
                          <v-select :options="rooms"
                            v-model="form.room"
                            :required="!form.room"
                            />
                    </div>
                    <div class="col-xs-4 form-group form-check">
                        <label  >Schedule days</label>
                        <!-- <select class="form-control" name="day" v-model="form.days" :class="{ 'is-invalid': form.errors.has('days') }">
                            <option value="M-W-F">M-W-F</option>
                            <option value="T-Th">T-TH</option>
                             <option value="M-T-W-Th-F">M-T-W-Th-F</option>
                            <option value="S">SAT</option>
                        </select> -->
                        <br>
                         
                        <span v-for="weekday in weekdays" :key="weekday.id" >
                             <input class="form-check-input" type="checkbox" :value="weekday.value" v-model="form.days">
                            <span>
                                <label for="checkbox">{{ weekday.name }}</label>
                                &nbsp;
                            </span> 
                        </span>
                        
                       
                    </div>
                    <div class="col-xs-2 form-group">
                        <label>Term</label>
                        <select class="form-control" name="term" v-model="form.term" :class="{ 'is-invalid': form.errors.has('term') }">
                            <option value="1">First</option>
                            <option value="2">Second</option>
                        </select>
                    </div>
                      <div class="col-xs-2 form-group">
                        <label>Semester</label>
                        <select class="form-control" name="sem" v-model="form.sem" :class="{ 'is-invalid': form.errors.has('sem') }">
                            <option value="1">First</option>
                            <option value="2">Second</option>
                        </select>
                    </div>
                      <div class="col-xs-2 form-group">
                        <label>School Year</label>
                        <input
                        v-model="form.schoolyr"
                        type="text"
                        name="schoolyr"
                        placeholder="School Year"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('schoolyr') }"
                      />
                      <has-error :form="form" field="schoolyr"></has-error>
                    </div>
                    <div class="col-xs-4 form-group">
                        <label>Start Time</label>
                        <date-picker   name="start_time" v-model="form.start_time" :config="options" :class="{ 'is-invalid': form.errors.has('start_time') }"></date-picker>
                         <has-error :form="form" field="start_time"></has-error>
                    </div>
                    <div class="col-xs-4 form-group">
                        <label>End Time</label>
                          <date-picker   name="end_time" v-model="form.end_time" :config="options" :class="{ 'is-invalid': form.errors.has('end_time') }" ></date-picker>
                     <has-error :form="form" field="end_time"></has-error>
                    </div>
                    <div class="col-xs-4 form-group">
                        <label for="">Assigned Checker</label>
                         <v-select :options="students"
                            v-model="form.student"
                            :required="!form.student"
                            />
                    </div>
                     
                      <button type="submit" class="btn btn-block btn-info"> Create</button>
                    <router-link to="/schedules" class="btn btn-block btn-danger">Back</router-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';
    export default {
        
        data() {
                return {
                    form: new Form({
                        room: '',
                        teacher: '',
                        subject: '',
                        days: [],
                        term:'',
                        sem:'',
                        start_time:'',
                        end_time:'',
                        schoolyr:'',
                        student:'',
                        
                    }),
                    subjectcodes: [],
                    teachers: [],
                    rooms: [],
                    students:[],
                    weekdays:[
                    { 'id': 1, "name": 'Mon','value':'M'},
                    { 'id': 2, "name":'Tue','value':'T'},
                    { 'id': 3, "name":'Wed','value':'W'},
                    { 'id': 4, "name":'Thu','value':'Th'},
                    { 'id': 5, "name":'Fri','value':'F'},
                    { 'id': 6, "name":'Sat','value':'S'}
                    ],
                    start_time: new Date(),
                    options: {
                    format: 'h:mm A',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                    },

                    end_time: new Date(),
                    options: {
                    format: 'h:mm A',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                    } 
                }
            },
            methods: {
                getSubjectCodes() {
                        axios.get('/getSubjectsCombo')
                            .then((res) => {
                                this.subjectcodes = res.data
                            })
                            .catch((e) => {
                                console.log(e)
                            })
                    },
                    getRooms() {
                        axios.get('/getRoomsCombo')
                            .then((res) => {
                                this.rooms = res.data
                            })
                            .catch((e) => {
                                console.log(e)
                            })
                    },
                    getTeachers() {
                        axios.get('/getTeachersCombo')
                            .then((res) => {
                                this.teachers = res.data
                                    // this.sortData()
                            })
                            .catch((e) => {
                                console.log(e)
                            })
                    },
                    createSchedule(){
                        this.form.post('/addSchedules')
                            .then(({data})=>{
                                swal.fire("Schedule Added!", "", "success");
                                  this.$router.push({path: '/schedules'})        
                            })
                            .catch((e)=>{
                                  console.log(e)
                                    swal.fire("Record Exist", "", "warning");
                            })
                           
                    },
                    getStudentSchedule(){
                        axios.get('/getStudentSchedule')
                            .then((res)=>{
                            this.students = res.data
                        })
                    }
            },
            created() {
                this.getStudentSchedule()
                this.getSubjectCodes()
                this.getTeachers()
                this.getRooms()
                console.log('Component mounted.')
            },
            
    }
</script>
