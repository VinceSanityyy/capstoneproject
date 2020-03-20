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
                           <b>Time</b> <a class="pull-right">{{schedule.start_time}} - {{schedule.end_time}}</a>
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
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Update Schedule</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <form @submit.prevent = updateSchedule>
                    <div class="col-xs-6 form-group">
                        <label>Select Teacher</label>
                        <select class="form-control" name="teacher" v-model="form.teacher_id" :class="{ 'is-invalid': form.errors.has('teacher') }">
                            <option :selected="form.teacher === teacher.id"   :value="teacher.id" v-for="teacher in teachers" :key="teacher.id">{{teacher.fullname}} - {{teacher.course}}</option>
                        </select>
                    </div>
                    <div class="col-xs-6 form-group">
                        <label>Subject</label>
                        <select class="form-control" name="subject" v-model="form.subject_code_id" :class="{ 'is-invalid': form.errors.has('subject') }">
                            <option :value="subjectcode.id" v-for="subjectcode in subjectcodes" :key="subjectcode.id">{{subjectcode.subject_code}} - {{subjectcode.subject_description}}</option>
                        </select>
                    </div>
                    <div class="col-xs-3 form-group">
                        <label>Room</label>
                        <select class="form-control" name="room" v-model="form.room_id" :class="{ 'is-invalid': form.errors.has('room') }">
                            <option :value="room.id" v-for="room in rooms" :key="room.id">{{room.room_desc}} - {{room.bldg}}</option>
                        </select>
                    </div>
                    <div class="col-xs-3 form-group">
                        <label>Schedule days</label>
                        <select class="form-control" name="day" v-model="form.day" :class="{ 'is-invalid': form.errors.has('day') }">
                            <option value="M-W-F">M-W-F</option>
                            <option value="T-TH">T-TH</option>
                             <option value="M-T-W-Th-F">M-T-W-Th-F</option>
                            <option value="SAT">SAT</option>
                        </select>
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
                    <div class="col-xs-5 form-group">
                        <label>Start Time</label>
                        <date-picker   name="start_time" v-model="form.start_time" :config="options" :class="{ 'is-invalid': form.errors.has('start_time') }"></date-picker>
                         <has-error :form="form" field="start_time"></has-error>
                    </div>
                    <div class="col-xs-5 form-group">
                        <label>End Time</label>
                          <date-picker   name="end_time" v-model="form.end_time" :config="options" :class="{ 'is-invalid': form.errors.has('end_time') }" ></date-picker>
                     <has-error :form="form" field="end_time"></has-error>
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

    export default {
        data() {
            return {
               
                editmode: false,
                teachers: [],
                subjectcodes: [],
                schedules: [],
                schedulesPagination:{},
                remarks: [],
                remark_id: '',
                rooms: [],
                cid:'',
                
                form: new Form({
                    id: '',
                    room: '',
                    teacher: '',
                    subject: '',
                    days: '',
                    term: '',
                    semester: '',
                    start_time: '',
                    end_time: '',
                    schoolyr: '',
                    scid:'',

                    teacher_id:'',
                    room_id:'',
                    subject_code_id:'',
                    day:'',
                    school_year:''
                }),

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
            getTeachers() {
                axios.get('getTeachers')
                    .then((res) => {
                        this.teachers = res.data
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            },
            getSubjectCodes() {
                axios.get('/getSubjectCodesCheckbox')
                    .then((res) => {
                        this.subjectcodes = res.data
                        // console.log(res)
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            },
            getRooms() {
                axios.get('/getRoomsCheckbox')
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
                this.editmode = true
                $('#exampleModal').modal('show')
                this.form.fill(schedule)
                console.log(this.form)
            },
            updateSchedule() {
                this.form.put('/updateSchedule/' + this.form.scid)
                    .then(() => {
                        swal.fire("Record Updated!", "", "success");
                        $('#exampleModal').modal('hide');
                        $(".modal-backdrop").remove();
                        this.getSchedulesPagination()
                    })
                    .catch((e) => {
                        // console.log(e)
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
        },

        created() {
           
            this.getTeachers();
            this.getSubjectCodes()
            // this.getSchedules()
            this.getSchedulesPagination()
            this.getTeachers()
            this.getRooms()
            console.log('Component mounted.')
        }
    } 
</script>