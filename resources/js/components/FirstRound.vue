<template>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-body box-profile">
                    <img :src="'img/'+schedule.image" alt="User profile picture" class="profile-user-img img-responsive img-circle" style="width:200px; height:200px">
                    <h3 class="profile-username text-center">Name: {{schedule.fullname}}</h3>
                    <p class="text-muted text-center"><b>Course: {{schedule.course}}</b></p>
                    
                    <router-link to="/schedules" class="btn btn-success btn-block">Back</router-link>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Remarks</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group" v-for="remark in remarks" :key="remark.id">    
                            <input class="form-check-input" name="radio" :checked="remark.id === details[0].remarks_id" type="radio" value="">
                            <label class="form-check-label">
                                {{remark.remarks_desc}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3" >
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Violations</h3>
                    </div>
                    <div class="box-body">
                  <!-- <div class="form-group" v-for="violation in violations" :key="violation.id">
                            <input class="form-check-input" :checked="violation.id === details[0].id"  type="checkbox" value=""> -->
                        <div class="form-group" v-for="violation in computedViolations2" :key="violation.id">
                            <input class="form-check-input" :checked="violation.checkboxIsTrue == true"   type="checkbox" value="">
                            <label  class="form-check-label" for="defaultCheck1">
                                {{violation.violation_details}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
                return {
                    schedule: [],
                    remarks: [],
                    violations: [],
                    rounds: [],
                    details: [],
                }
            },

            computed:{
                computedViolations(){
                    return this.violations.map(obj => {
                            obj.checkboxIsTrue = false;
                            return obj;
                    });
                },
                computedViolations2(){
                    return this.computedViolations.map(obj => {
                            this.details.forEach(detail => {
                                if(detail.id == obj.id){
                                    obj.checkboxIsTrue = true;
                                }
                            });
                            return obj;
                    });
                }
           },




            methods: {
                getViolations() {
                        axios.get('getViolations')
                            .then((res) => {
                                this.violations = res.data
                            })
                    },
                    getRemarks() {
                        axios.get('getRemarks')
                            .then((res) => {
                                 this.remarks = res.data
                            })
                    },
                    getRound() {
                        axios.get('getRound')
                            .then((res) => {
                                this.rounds = res.data
                            })
                    },
                    getDetails() {
                        axios.get('getDetails/' + this.schedule.id)
                            .then((res) => {
                                this.details = res.data
                                console.log(this.details)
                            })
                    },
                   
            },
            created() {
                this.schedule = this.$router.currentRoute.params
                this.getRound()
                this.getViolations()
                this.getRemarks()
                this.getDetails()
                console.log('Component mounted.')
            },

           
    }
</script>