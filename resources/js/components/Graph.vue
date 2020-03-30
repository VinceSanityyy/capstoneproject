<template>
   <div class="col-xs-12">
      <div class="box box-danger">
         <h3 class="box-title" style="text-align:center">Statistics</h3>
         <div class="box-body">
            <div class="col-xs-12 form-group">
               <label>Select Teacher</label>
               <v-select :options="teachers"
                            v-model="teacher"
                            @input="onChange($event)"         
                />
               <!-- <select @change="getdata(),getViolationsData()" class="form-control" name="teacher" v-model="teacher">
                  <option :value="teacher.id" v-for="teacher in teachers" :key="teacher.id">{{teacher.fullname}}</option>
               </select> -->
            </div>
             <div class="col-md-6">
               <div class="box box-danger">
                  <div class="box-header with-border">
                     <h3 style="text-align:center" class="box-title">Absences</h3>
                  </div>
                  <div  align="left" id="chart-violations">
                     <fusioncharts :type="chart1.type" :width="chart1.width" :height="chart1.height" :dataFormat="chart1.dataFormat" :dataSource="chart1.dataSource ">
                     </fusioncharts>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="box box-danger">
                  <div class="box-header with-border">
                     <h3 style="text-align:center" class="box-title">Violations</h3>
                  </div>
                  <div  align="left" id="chart-container">
                     <fusioncharts :type="chart2.type" :width="chart2.width" :height="chart2.height" :dataFormat="chart2.dataFormat" :dataSource="chart2.dataSource ">
                     </fusioncharts>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
    import Vue from 'vue';
    import VueFusionCharts from 'vue-fusioncharts';
    import FusionCharts from 'fusioncharts';
    import Column2D from 'fusioncharts/fusioncharts.charts';
    import FusionTheme from 'fusioncharts/themes/fusioncharts.theme.fusion';
    Vue.use(VueFusionCharts, FusionCharts, Column2D, FusionTheme);
    export default {
        name: 'app',
        data() {
            return {
                teachers: [],
                teacher: '',
                chart1: {
                type: "doughnut2d",
                renderAt: "chart-violations",
                width: "500",
                height: "320",
                dataFormat: 'json',
                dataSource: {
                    chart: {
                        // caption: "Absences",
                        theme: "fusion",
                        decimals: 0,
                        showpercentvalues: "0",
                        exportenabled: '1',
                        exportfilename: 'Violations',
                        },
                    data: []
                    },
                },
                chart2: {
                type: "doughnut2d",
                renderAt: "chart-container",
                width: "500",
                height: "300",
                dataFormat: 'json',
                dataSource: {
                    chart: {
                        // caption: "Absences",
                        theme: "fusion",
                        decimals: 2,
                        showpercentvalues: 1,
                        exportenabled: '1',
                        exportfilename: 'Absent',
                        },
                    data: []
                    },
                }
            }
        },
        methods: {
            getTeachers() {

                    axios.get('getTeachersCombo')
                        .then((res) => {
                            this.teachers = res.data
                        })
                        .catch((e) => {
                            console.log(e)
                           
                        })
                },
                getdata() {
                    let self = this
                    axios.get('/getGraph/' + self.teacher.id)
                        .then(({
                            data
                        }) => {
                            console.log(data)
                            self.chart1.dataSource.data = []
                            data.date.forEach(x => {
                                this.chart1.dataSource.data.push(x);
                            });
                        })
                },
                getViolationsData(){
                    let self = this
                    axios.get('/violationsGraph/' + self.teacher.id)
                      .then((res)=>{
                          console.log(res)
                          self.chart2.dataSource.data = []
                          res.data.forEach(val=>{
                              this.chart2.dataSource.data.push(val)
                          })
                      })
                },
                onChange(event) {
                    this.getViolationsData()
                    this.getdata()
                }
        },
        created: function() {
            //    this.getdata();
            this.getTeachers()

        }
    }
</script>