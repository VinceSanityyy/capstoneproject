<template>
   <div class="row">
       <div class="col-xs-12">
           <div class="box box-danger">
              <div class="box-header">
                   <h3 class="box-title">Generate Weekly Report</h3>
              </div>
              <div class="box-body">
               <form action="">
                   <div class="col-xs-3 form-group">
                       <label for="">From: </label>
                       <input type="date" name="" id="">
                   </div>
                       <div class="col-xs-3 form-group">
                       <label for="">To: </label>
                       <input type="date" name="" id="">
                   </div>
                   <button class="btn btn-info">Genarate</button>
               </form>
            </div>
           </div>
       </div>
   </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
