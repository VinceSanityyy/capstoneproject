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
                        <select class="form-control" name="teacher" v-model="form.teacher" :class="{ 'is-invalid': form.errors.has('teacher') }">
                            <option :value="teacher.id" v-for="teacher in teachers" :key="teacher.id">{{teacher.fullname}} - {{teacher.course}}</option>
                        </select>
                    </div>
                    <div class="col-xs-6 form-group">
                        <label>Subject</label>
                        <select class="form-control" name="subject" v-model="form.subject" :class="{ 'is-invalid': form.errors.has('subject') }">
                            <option :value="subjectcode.id" v-for="subjectcode in subjectcodes" :key="subjectcode.id">{{subjectcode.subject_code}} - {{subjectcode.subject_description}}</option>
                        </select>
                    </div>
                    <div class="col-xs-3 form-group">
                        <label>Room</label>
                        <select class="form-control" name="room" v-model="form.room" :class="{ 'is-invalid': form.errors.has('room') }">
                            <option :value="room.id" v-for="room in rooms" :key="room.id">{{room.room_desc}} - {{room.bldg}}</option>
                        </select>
                    </div>
                    <div class="col-xs-3 form-group">
                        <label>Schedule days</label>
                        <select class="form-control" name="day" v-model="form.days" :class="{ 'is-invalid': form.errors.has('days') }">
                            <option value="M-W-F">M-W-F</option>
                            <option value="T-TH">T-TH</option>
                             <option value="M-T-W-T-F">M-T-W-Th-F</option>
                            <option value="SAT">SAT</option>
                        </select>
                    </div>
                    <div class="col-xs-2 form-group">
                        <label>Term</label>
                        <select class="form-control" name="term" v-model="form.term" :class="{ 'is-invalid': form.errors.has('term') }">
                            <option value="2">First</option>
                            <option value="1">Second</option>
                        </select>
                    </div>
                      <div class="col-xs-2 form-group">
                        <label>Semester</label>
                        <select class="form-control" name="sem" v-model="form.sem" :class="{ 'is-invalid': form.errors.has('sem') }">
                            <option value="2">First</option>
                            <option value="1">Second</option>
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
                     
                      <button type="submit" class="btn btn-block btn-info"> Create</button>
                    <router-link to="/schedules" class="btn btn-block btn-danger">Back</router-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  

    export default {
        
        data() {
                return {
                    form: new Form({
                        room: '',
                        teacher: '',
                        subject: '',
                        days: '',
                        term:'',
                        sem:'',
                        start_time:'',
                        end_time:'',
                        schoolyr:''
                    }),
                    subjectcodes: [],
                    teachers: [],
                    rooms: [],

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
                        axios.get('/getSubjectCodes')
                            .then((res) => {
                                this.subjectcodes = res.data
                                    // console.log(res)
                            })
                            .catch((e) => {
                                console.log(e)
                            })
                    },
                    getRooms() {
                        axios.get('/getRooms')
                            .then((res) => {
                                this.rooms = res.data
                            })
                            .catch((e) => {
                                console.log(e)
                            })
                    },
                    getTeachers() {
                        axios.get('getTeachers')
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
                                swal.fire("Subject Updated!", "", "success");
                            })
                             console.log(this.form)
                    }
            },
            created() {
                this.getSubjectCodes()
                this.getTeachers()
                this.getRooms()
                console.log('Component mounted.')
            },
            
    }
</script>
