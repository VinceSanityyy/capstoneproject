<template>
   <div class="row">
       <div class="col-xs-12">
           <div class="box box-danger">
              <div class="box-header">
                   <h3 class="box-title">Generate Report</h3>
              </div>
              <div class="box-body">
               <form action="">
                   <div class="col-xs-4 form-group">
                        <label>Start Date</label>
                       <date-picker name="from" id="from" v-model="from" :config="options" ></date-picker>
                    </div>
                    <div class="col-xs-4 form-group">
                        <label>End Date</label>
                          <date-picker name="to" id="to" v-model="to" :config="options" ></date-picker>
                    </div>
               </form>
            </div>
            <div class="box-footer">
                  <a type="button" @click="generate()" >
                    <button  class="btn btn-info">
                        Generate Excel from Preview
                    </button>
                </a>
                  <a type="button" @click="preview(),departmentAbsent(),departmentViolation()" >
                    <button  class="btn btn-info">
                      Preview Result
                    </button>
                </a>
            </div>
           </div>
       </div>
       <div class="col-xs-12">
         <div class="box box-info">
             <div class="box-header">
                   <h3 class="box-title">Result Preview</h3>
              </div>
            <div class="box-body">
               <table class="table table-hover">
                  <tbody>
                     <tr>
                        <th>Teacher Name</th>
                        <th>ID Number</th>
                        <th>Department</th>
                        <th>Subject</th>
                        <th>Remarks</th>
                        <th>Date</th>
                     </tr>
                     <tr v-for="result in results" :key="result.id">
                        <td>{{result.Name}}</td>
                        <td>{{result.ID}}</td>
                        <td>{{result.Department}}</td>
                        <td>{{result.Subject}}</td>
                        <td>{{result.Remarks}}</td>
                        <td>{{result.Date}}</td>
                    </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="col-xs-12">
          <div class="box box-warning">
              <div class="box-header">
                  <h3 class="box-title">Other Details</h3>
              </div>
              <div class="box-body">
                     <div class="col-md-6">
          <div class="box box-danger">
              <div class="box-header">
              </div>
              <div class="box-header with-border">
                     <h3 style="text-align:center" class="box-title">Department Absences Overview</h3>
                </div>
              <div class="box-body">
                  <div id="department-chart">
                      <fusioncharts :type="departmentChart.type" 
                        :width="departmentChart.width" 
                        :height="departmentChart.height" :dataFormat="departmentChart.dataFormat" 
                        :dataSource="departmentChart.dataSource ">
                        </fusioncharts>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-6">
          <div class="box box-danger">
              <div class="box-header">
              </div>
              <div class="box-header with-border">
                     <h3 style="text-align:center" class="box-title">Department Violations Overview</h3>
                </div>
              <div class="box-body">
                  <div id="department-chart-violations">
                      <fusioncharts :type="departmentViolationChart.type" 
                        :width="departmentViolationChart.width" 
                        :height="departmentViolationChart.height" :dataFormat="departmentViolationChart.dataFormat" 
                        :dataSource="departmentViolationChart.dataSource ">
                        </fusioncharts>
                  </div>
              </div>
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
        data(){
            return{
                    from: new Date(),
                    options: {
                    format: 'YYYY-MM-DD',
                    showClear: true,
                    showClose: true,
                    },

                    to: new Date(),
                    options: {
                    format: 'YYYY-MM-DD',
                    showClear: true,
                    showClose: true,
                    },
                    results:[],
                    departmentAbsences:[],
                    departmentViolations:[],

                    departmentChart:{
                        type: 'doughnut2d',
                        renderAt:'department-chart',
                        width:'500',
                        height:'300',
                        dataFormat:'json',
                        dataSource:{
                            chart:{
                                theme:'fusion',
                                exportenabled: '1',
                                exportfilename: 'Department Absent',
                            },
                            data:[]
                        }
                    },
                    departmentViolationChart:{
                        type: 'column2d',
                        renderAt:'department-chart-violation',
                        width:'500',
                        height:'300',
                        dataFormat:'json',
                        dataSource:{
                            chart:{
                                theme:'fusion',
                                exportenabled: '1',
                                exportfilename: 'Department Violations',
                            },
                            data:[]
                        }
                    }
            }
        },
        created() {
            console.log('Component mounted.')
        },
        methods:{
            generate(){
                let params = { from: this.from, to: this.to };
                let paramString = new URLSearchParams(params);
                window.open(`/generate?${paramString.toString()}`);
            },
            preview(){
                let params = { from: this.from, to: this.to };
                let paramString = new URLSearchParams(params);
                axios.get(`/preview?${paramString.toString()}`)
                    .then((res)=>{
                        this.results = res.data
                    })
            },
            departmentAbsent(){
                let params = { from: this.from, to: this.to };
                let paramString = new URLSearchParams(params);
                axios.get(`/generateDepartmentAbsent?${paramString.toString()}`)
                    .then((res)=>{
                        console.log(res)
                        this.departmentChart.dataSource.data=[]
                        res.data.forEach(val=>{
                            this.departmentChart.dataSource.data.push(val)
                        })
                    })
            },
            departmentViolation(){
                let params = { from: this.from, to: this.to };
                let paramString = new URLSearchParams(params);
                axios.get(`/generateDepartmentViolation?${paramString.toString()}`)
                    .then((res)=>{
                        console.log(res)
                        this.departmentViolationChart.dataSource.data=[]
                        res.data.forEach(val=>{
                            this.departmentViolationChart.dataSource.data.push(val)
                        })
                    })
            }
        }
    }
</script>
