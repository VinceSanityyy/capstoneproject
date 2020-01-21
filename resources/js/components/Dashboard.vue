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
              <h3>10</h3>
              <p>Teachers on Time</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
              <p>Late</p>
            </div>
            <div class="icon">
              <i class="ion ion-close"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
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
        </div>
        <div class="col-xs-12">
          <div class="box box-danger">
            <h3 class="box-title" style="text-align:center">Statistics</h3>
            <div class="box-tools">
              <div class="col-xs-12 form-group">
                        <label>Select Teacher</label>
                        <select class="form-control" name="teacher" v-model="teacher" >
                            <option :value="teacher.id" v-for="teacher in teachers" :key="teacher.id">{{teacher.fullname}}</option>
                        </select>
                    </div>
            </div>
            <div class="box-body">
                <graph></graph>
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
          teacher:''
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
      },
        created() {
            console.log('Component mounted.')
            this.getTeachers()
        }
    }
</script>
