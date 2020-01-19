<template>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-danger">
                <div class="box-body box-profile">
                    <img :src="'img/'+schedule.image" alt="User profile picture" class="profile-user-img img-responsive img-circle" style="width:200px; height:200px">
                    <h3 class="profile-username text-center">Name: {{schedule.fullname}}</h3>
                    <p class="text-muted text-center"><b>Course: {{schedule.course}}</b></p>
                    <button class="btn btn-primary btn-block">Save</button>
                    <router-link to="/schedules" class="btn btn-info btn-block">Back</router-link>
                </div>
            </div>
        </div>
        <div class="row" v-for="detail in details" :key="detail.id">
            <div class="col-xs-3">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Violations</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-check-input" checked="checked" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                {{detail.violation_details}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="box box-success">
                    <div class="box-header">
                        <h3 class="box-title">Remarks</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <input class="form-check-input" checked="checked" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                {{detail.remarks_desc}}
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
            methods: {
                getViolations() {
                        axios.get('getViolations')
                            .then((res) => {
                                this.violations = res.data
                            })
                    },
                    getRemarks() {
                        axios.get('getRemarks')
                            .then((res) => {})
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