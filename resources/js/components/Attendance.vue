<template>
   <div class="row">
       <div class="col-xs-12">
           <div class="box box-danger">
              <div class="box-header">
                   <h3 class="box-title">Generate Weekly Report</h3>
              </div>
              <div class="box-body">
               <form action="">
                   <div class="col-xs-4 form-group">
                        <label>Start Date</label>
                       <date-picker :config="options" ></date-picker>
                    </div>
                    <div class="col-xs-4 form-group">
                        <label>End Date</label>
                          <date-picker :config="options" ></date-picker>
                    </div>
               </form>
            </div>
            <div class="box-footer">
                  <!-- <button  class="btn btn-info">Genarate Excel</button> -->
                  <a type="button" href="/generate" >
                    <button  class="btn btn-info">
                        Generate Excel
                    </button>
                </a>
            </div>
           </div>
       </div>
   </div>
</template>

<script>
    export default {
        data(){
            return{
                    date: new Date(),
                    options: {
                    format: 'd/MM/YYYY',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                    },
            }
        },
        created() {
            console.log('Component mounted.')
        },
        methods:{
            generate(){
                axios.get('/generate')
                    .then((res)=>{
                        console.log('asd')
                    })
            }
        }
    }
</script>
