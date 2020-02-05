<template>
  <div class="row">
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>
    <br>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{teacher_count}}</h3>
              <p>Total Teachers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
               <router-link to="/teachers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{subject_count}}<sup style="font-size: 20px"></sup></h3>
              <p>Total Subjects</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
               <router-link to="/subjectcodes" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{checkers_count}}</h3>
              <p>Total Attendance Checked today</p>
            </div>
            <div class="icon">
              <i class="fa fa-check"></i>
            </div>
            <router-link to="/checkers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
           
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
       
            <div class="inner">
              <h3>{{student_count}}</h3>
              <p>Total Number of Checkers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <router-link to="/checkers_list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></router-link>
          </div>
        </div> 
      <graph></graph>
      </div>
</template>

<script>
    export default {
      data(){
        return{
          teacher_count:[],
          subject_count:[],
          checkers_count:[],
          student_count:[]
        }
      },
      methods:{
        countTeachers(){
          axios.get('/countTeachers')
            .then((res)=>{
              this.teacher_count = res.data
            })
        },
        countSubjects(){
          axios.get('/countSubjects')
            .then((res)=>{
              this.subject_count = res.data
            })
        },
        countCheckers(){
          axios.get('/countCheckers')
            .then((res)=>{
              this.checkers_count = res.data
            })
        },
        countStudent(){
          axios.get('/getStudentCount')
            .then((res)=>{
              this.student_count = res.data
            })
        }
      },
        mounted() {
          this.countTeachers()
          this.countSubjects()
          this.countCheckers()
          this.countStudent()
          console.log('Component mounted.')
        
        }
    }
</script>
