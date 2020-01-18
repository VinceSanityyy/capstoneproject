<template>
  <div class="row">
      <div class="col-md-4">
          <div class="box box-danger">
              <div class="box-body box-profile">
                 <img :src="'img/'+schedule.image" alt="User profile picture"  class="profile-user-img img-responsive img-circle" style="width:200px; height:200px"> 
               <h3 class="profile-username text-center">Name: {{schedule.fullname}}</h3>
               <p class="text-muted text-center"><b>Course: {{schedule.course}}</b></p>
              </div>
          </div>
      </div>
        <div class="col-xs-4">
              <div class="box box-danger">
                  <h3 class="box-title">Violations</h3>
              </div>
          </div>
            <div class="col-xs-4">
              <div class="box box-danger" v-for="detail in details" :key="detail.id" >
                  <h3 class="box-title">{{detail.remarks_desc}}</h3>
                  
              </div>
          </div>

  </div>
</template>

<script>
    export default {
        data(){
            return{
                schedule:[],
                remarks:[],
                violations:[],
                rounds:[],
                details:[],
            }
        },
        methods:{
            getViolations(){
                axios.get('getViolations')
                    .then((res)=>{
                        this.violations = res.data
                    })
            },
            getRemarks(){
                axios.get('getRemarks')
                    .then((res)=>{
                    })
            },
            getRound(){
                   axios.get('getRound')
                    .then((res)=>{
                        this.rounds = res.data
                    })
            },
            getDetails(){
                axios.get('getDetailsTwo/'+this.schedule.id)
                    .then((res)=>{
                        this.details = res.data
                        console.log(this.details)
                    })
            }
        },
        created() {
            this.schedule = this.$router.currentRoute.params
            this.getRound()
            this.getViolations()
            this.getRemarks();
            this.getDetails();
            console.log('Component mounted.')
        }
    }
</script>
