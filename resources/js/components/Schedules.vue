<template>
   <div class="col-xs-12">
      <div class="box">
         <div class="box-header">
            <h3 class="box-title">Schedules</h3>
            <br>
            <div class="box-tools">
               <router-link to="/addSchedules" class="btn btn-primary pull-left">Add new <i class="fa fa-plus"></i></router-link>
               <br>
            </div>
         </div>
         <div class="row" >
            <div class="col-md-4 " 
               v-for="(schedule, index) in schedulesPagination.data" :key="index.id">
               <div class="box box-primary">
                  <div class="box-body box-profile">
                     <img class="profile-user-img img-responsive img-circle" :src="'img/'+schedule.image" style="max-width: 100%;height: 100px;"  alt="User profile picture">
                     <h3 class="profile-username text-center">{{schedule.fullname}}</h3>
                     <p class="text-muted text-center">Department: {{schedule.course}}</p>
                     <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                           <b>Subject Code</b> <a class="pull-right">{{schedule.subject_code}}</a>
                        </li>
                        <li class="list-group-item">
                           <b>Subject Title</b> <a class="pull-right">{{schedule.subject_description}}</a>
                        </li>
                        <li class="list-group-item">
                           <b>Room</b> <a class="pull-right">{{schedule.room_desc}}</a>
                        </li>
                        <li class="list-group-item">
                           <b>Days</b> <a class="pull-right">{{schedule.day}}</a>
                        </li>
                        <li class="list-group-item">
                           <b>Time</b> <a class="pull-right">{{ `${$moment().format('YYYY-MM-DD')} ${schedule.start_time}` |  moment('hh:m A') }} - {{ `${$moment().format('YYYY-MM-DD')} ${schedule.end_time}` |  moment('hh:m A') }}</a>
                        </li>
                           <li class="list-group-item">
                           <b>Assigned Checker</b> <a class="pull-right">{{schedule.name}}</a>
                        </li>
                         </li>
                           <li v-if="schedule.term == 1" class="list-group-item">
                           <b >Term</b> <a  class="pull-right">First</a>
                        </li>
                        </li>
                           <li v-else class="list-group-item">
                           <b >Term</b> <a  class="pull-right">Second</a>
                        </li>
                        </li>
                           <li v-if="schedule.semester == 1" class="list-group-item">
                           <b>Semester</b> <a class="pull-right">First</a>
                        </li>
                         </li>
                           <li v-else class="list-group-item">
                           <b>Semester</b> <a class="pull-right">Second</a>
                        </li>
                     </ul>
                     <button data-target="#exampleModal" @click="editModal(schedule)" type="button" class="btn btn-info btn-block" data-toggle="modal">Update</button>
                    <button  @click="deleteSchedule(schedule.scid)" type="button" class="btn btn-danger btn-block">Delete</button>
                  </div>
               </div>
            </div>
         </div>
         <div class="box-foote">
                <pagination :data="schedulesPagination" @pagination-change-page="getSchedulesPagination"></pagination>
         </div>
      </div>
      <!-- Modal -->
      <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" style=" width: 1000px;">
         <div class="modal-content">
            <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Update Schedule</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                     <!-- :reduce="country => country.code" label="country" -->
                   <form @submit.prevent = updateSchedule>
                    <div class="col-xs-6 form-group">
                        <label>Select Teacher</label>
                        <v-select :options="teachers"
                            v-model="tid"
                            :required="!form.teacher"
                            :value = "tid"
                            />
                    </div>
                    <div class="col-xs-6 form-group">
                        <label>Subject</label>
                         <v-select :options="subjectcodes"
                            v-model="sc_code"
                            :required="!form.subject"
                            />
                    </div>
                    <div class="col-xs-2 form-group">
                        <label>Room</label>
                          <v-select :options="rooms"
                            v-model="room_id"
                            :required="!form.room"
                        />
                    </div>
                    <div class="col-xs-4 form-group form-check">
                        <label>Schedule days</label>
                         <br>
                         
                        <span >
                              <input type="checkbox"  value="Mon" v-model="day">
                              <label for="">Mon</label>
                              <input type="checkbox"  value="Tue" v-model="day">
                              <label for="">Tue</label>
                              <input type="checkbox" value="Wed" v-model="day">
                              <label for="">Wed</label>
                              <input type="checkbox"  value="Thu" v-model="day">
                              <label for="">Thu</label>
                              <input type="checkbox"  value="Fri" v-model="day">
                              <label for="">Fri</label>
                              <input type="checkbox" value="Sat" v-model="day">
                              <label for="">Sat</label>
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
                        <select class="form-control" name="sem" v-model="form.semester  " :class="{ 'is-invalid': form.errors.has('sem') }">
                            <option value="1">First</option>
                            <option value="2">Second</option>
                        </select>
                    </div>
                      <div class="col-xs-2 form-group">
                        <label>School Year</label>
                        <input
                        v-model="form.school_year"
                        type="text"
                        name="schoolyr"
                        placeholder="School Year"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('school_year') }"
                      />
                      <has-error :form="form" field="schoolyr"></has-error>
                    </div>
                    <div class="col-xs-3 form-group">
                        <label>Start Time</label>
                        <date-picker   name="start_time" v-model="form.start_time" :config="options" :class="{ 'is-invalid': form.errors.has('start_time') }"></date-picker>
                         <has-error :form="form" field="start_time"></has-error>
                    </div>
                    <div class="col-xs-3 form-group">
                        <label>End Time</label>
                          <date-picker   name="end_time" v-model="form.end_time" :config="options" :class="{ 'is-invalid': form.errors.has('end_time') }" ></date-picker>
                     <has-error :form="form" field="end_time"></has-error>
                    </div>
                    <div class="col-xs-4 form-group">
                        <label for="">Assigned Checker</label>
                         <v-select :options="students"
                            v-model="student_id"
                            @input="setSelected"
                            :required="!form.student"
                            />
                    </div>
                    
                      <button type="submit" class="btn btn-block btn-info"> Update</button>
                     <button type="submit" data-dismiss="modal" class="btn btn-block btn-danger"> Close</button>
                    </form>
                </div>
         </div>
      </div>
      </div>
      <!-- Modal -->
   </div>
</template>

<script >
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';
    export default {
        data() {
            return {
                tid:'',
                room_id:'',
                sc_code:'',
                teacher:'',
                checker_id:{},
                student_id:'',
                editmode: false,
                teachers: [],
                students:[],
                subjectcodes: [],
                schedules: [],
                schedulesPagination:{},
                remarks: [],
                remark_id: '',
                rooms: [],
                cid:'',
                weekdays:[
                    { 'id': 1, "name": 'Mon','value':'Mon'},
                    { 'id': 2, "name":'Tue','value':'Tue'},
                    { 'id': 3, "name":'Wed','value':'Wed'},
                    { 'id': 4, "name":'Thu','value':'Thu'},
                    { 'id': 5, "name":'Fri','value':'Fri'},
                    { 'id': 6, "name":'Sat','value':'Sat'}
                ],
                day:[],
                form: new Form({
                    id: '',
                    room: '',
                    teacher: '',
                    subject: '',
                    term: '',
                    semester: '',
                    start_time: '',
                    end_time: '',
                    schoolyr: '',
                    scid:'',
                    tid:{},
                    teacher_id:'',
                    room_id:'',
                    subject_code_id:'',
                    day:[],
                    school_year:'',
                   
                }),
                start_time: new Date(),
                options: {
                    format: 'hh:mm A',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                },
                end_time: new Date(),
                options: {
                    format: 'hh:mm A',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                }
            }
        },
        computed:{
          
        },
        methods: {
            getSchedulesPagination(page) {
                if (typeof page === 'undefined') {
                            page = 1;
                        }
                axios.get('/getSchedulesPaginate?page=' + page)
                        .then(data => {
                                this.schedulesPagination = data.data;
                            });
            },
            setSelected(value){

            },
            getTeachers() {
                axios.get('getTeachersCombo')
                    .then((res) => {
                        this.teachers = res.data
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            },
            getSubjectCodes() {
                axios.get('/getSubjectsCombo')
                    .then((res) => {
                        this.subjectcodes = res.data
                        // console.log(res)
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
            getSchedules() {
                axios.get('/getSchedules')
                    .then((res) => {
                        this.schedules = res.data
                        // console.log(res)
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            },
            editFirstRound(data) {
                this.$router.push({
                    name: 'editFirst',
                    params: data
                })
            },
            editSecondRound(data) {
                this.$router.push({
                    name: 'editSecond',
                    params: data
                })
            },
            editModal(schedule) {
                console.log(schedule)
                this.tid = 
                    { 'id': schedule.teacher_id, "label": schedule.fullname +' - '+ schedule.id_number},
                
                this.room_id = 
                    {'id': schedule.room_id, 'label': schedule.room_desc}
                
                this.sc_code = 
                    { 'id': schedule.subject_code_id, "label": schedule.subject_code +' - '+ schedule.subject_description}
                
                this.student_id = 
                    { 'id': schedule.student_id, "label": schedule.name}

               
                this.day = schedule.day
                this.day = this.day.split(",")
                if(this.day[0] == ""){
                this.day.shift()
                }
                console.log(this.day)
                this.editmode = true
                $('#exampleModal').modal('show')
                this.form.fill(schedule)
               
            },
            updateSchedule() {
                let params = {day: this.day}
                axios.put('/updateSchedule/' + this.form.scid,{
                    tid: this.tid.id,
                    room_id:this.room_id.id,
                    start_time: this.form.start_time,
                    end_time: this.form.end_time,
                    day: this.day,
                    term: this.form.term,
                    semester: this.form.semester,
                    subject_code_id: this.sc_code.id,
                    school_year: this.form.school_year,
                    student_id: this.student_id.id

                })
                    .then(() => {
                        swal.fire("Record Updated!", "", "success");
                        $('#exampleModal').modal('hide');
                        $(".modal-backdrop").remove();
                        this.getSchedulesPagination()
                    })
                    .catch((res) => {
                        console.log(res)
                        swal.fire("Record Exist", "", "warning");
                        $('#exampleModal').modal('hide');
                        $(".modal-backdrop").remove();
                        this.getSchedulesPagination()
                    })
            },
            deleteSchedule(scid){
                	swal.fire({
					title: "Are you sure?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Yes, delete it!"
				}).then(result => {
					if (result.value) {
						this.form.delete('deleteSchedule/' + scid)
							.then(() => {
								swal.fire("Deleted!", "", "success");
                	 this.getSchedulesPagination()
							})
							.catch(() => {
								swal.fire("Something went wrong.", "", "warning");
							});
					}
				});
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
            this.getTeachers();
            this.getSubjectCodes()
            // this.getSchedules()
            this.getSchedulesPagination()
            this.getTeachers()
            this.getRooms()
            
        }
    } 
</script>