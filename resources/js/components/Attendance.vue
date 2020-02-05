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
                  <a type="button" @click="preview()" >
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
                        <th>Subject</th>
                        <th>Remarks</th>
                        <th>Date</th>
                     </tr>
                     <tr v-for="result in results" :key="result.id">
                        <td>{{result.Name}}</td>
                        <td>{{result.ID}}</td>
                        <td>{{result.Subject}}</td>
                        <td>{{result.Remarks}}</td>
                        <td>{{result.Date}}</td>
                    </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
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
                    
                    results:[]
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
        }
    }
</script>
