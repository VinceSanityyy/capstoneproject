<template>
   <div class="row">
       <div class="col-xs-12">
           <div class="box box-danger">
              <div class="box-header">
                   <h3 class="box-title">View Attendance Summary</h3>
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
                        Show Report
                    </button>
                </a>
            </div>
           </div>
       </div>
       <div class="col-xs-12">
           <div class="box box-info">
            <div class="box-body">
                     <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Remarks</th>
                            <th>Date</th>
                        </tr>
                        <tr v-for="result in results" :key="result.id">
                            <td>{{result.fullname}}</td>
                            <td>{{result.subject_description}}</td>
                            <td>{{result.remarks_desc}}</td>
                            <td>{{result.created_at}}</td>
                        </tr>
                    </tbody>
                </table>
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
                    results:[],
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
                axios.get(`/generatePersonal?${paramString.toString()}`)
                    .then((res)=>{
                        this.results = res.data
                    })
            }
        }
    }
</script>
