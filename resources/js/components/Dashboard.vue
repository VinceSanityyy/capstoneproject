<template>
  <div class="row">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
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
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>10</h3>

              <p>Absent</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>
              <p>Total Teachers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
      <graph></graph>
      </div>
</template>

<script>
    export default {
      data(){
        return{
          teacher_count:[],
          subject_count:[]
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
        }
      },
        mounted() {
          this.countTeachers()
          this.countSubjects()
          console.log('Component mounted.')
        
        }
    }
</script>
