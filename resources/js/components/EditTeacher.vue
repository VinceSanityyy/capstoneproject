<template>
 <div class="row">
     <div class="col-xs-3">
     <div class="box">
         <div class="box-tools">
             <img style="border-radius: 50%;" src=""   height="100" width="50">
         </div>
     </div>
 </div>
 <div class="col-xs-9">
     <div class="box">
         
     </div>
 </div>
 <div v-for="(teacher,index) in teachers" :key="index">
    {{teacher}}
 </div>
 </div>
</template>

<script>
    export default {
        data() {
            return {
                teachers: []
            }
        },
        mounted() {
            this.teachers = this.$router.currentRoute.params
        }
    }
</script>
