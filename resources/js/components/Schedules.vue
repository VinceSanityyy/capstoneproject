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
               v-for="(schedule, index) in schedules" :key="index.id">
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
                     <!-- <a href="#"  @click="editFirstRound(schedule)" class="btn btn-primary btn-block">First Round</a>
                        <button  @click="editSecondRound(schedule)" class="btn btn-primary btn-block">Second Round</button>
                        <button @click="editModal(schedule)"  data-toggle="modal" data-target="#exampleModal" class="btn btn-info btn-block">Set Overall Remarks</button> -->
                     <button class="btn btn-danger btn-block">Delete </button>
                  </div>
                  <!-- /.box-body -->
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   export default {
       data(){
           return{
               teachers:[],
               subjectcodes:[],
               schedules:[],
               remarks:[],
               remark_id:'',
                form: new Form({
                        id:'',
                        start_time:'',
                        end_time:'',
                        overall:'',
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
       methods:{
           getTeachers(){
               axios.get('getTeachers')
                   .then((res)=>{
                       this.teachers = res.data
                       // this.sortData()
                   })
                   .catch((e)=>{
                       console.log(e)
                   })
           },
              getSubjectCodes(){
             axios.get('/getSubjectCodes')
                 .then((res)=>{
                   this.subjectcodes = res.data
                   // console.log(res)
                 })
                 .catch((e)=>{
                   console.log(e)
                 })
         },
         getSchedules(){
              axios.get('/getSchedules')
                 .then((res)=>{
                   this.schedules = res.data
                   // console.log(res)
                 })
                 .catch((e)=>{
                   console.log(e)
                 })
         },
         editFirstRound(data){
            this.$router.push({name:'editFirst',params: data})
         },
          editSecondRound(data){
            this.$router.push({name:'editSecond',params: data})
         },
            editModal(schedule){
            this.editmode = true
            $('#exampleModal').modal('show')
            this.form.fill(schedule)
          },
       
       },
       created() {
           this.getTeachers();
           this.getSubjectCodes()
           this.getSchedules()
           
           console.log('Component mounted.')
       }
   }
</script>