<template>
   <div class="row">
     
      <div class="col-md-3">
         <div class="box box-danger" >
            <div class="box-body box-profile">
               <img :src="'img/'+teachers.image" alt="User profile picture"  class="profile-user-img img-responsive img-circle" style="width:200px; height:200px"> 
               <h3 class="profile-username text-center">Name: {{teachers.fullname}}</h3>
               <p class="text-muted text-center"><b>Course: {{teachers.course}}</b></p>
                <p class="text-muted text-center"><b>Contact No: {{teachers.contact}}</b></p>
            </div>
         </div>
      </div>
      <div class="col-xs-9">
         <div class="box box-danger">
            <div class="box-header">
               <h3 class="box-title">Teacher Details</h3>
            </div>
            <div class="box-body">
               <form @submit.prevent = editTeacher>
                  <div class="col-xs-6 form-group">
                     <label>Name</label>
                     <input v-model="form.fullname" 
                        type="text" 
                        name="fullname"
                        class="form-control" 
                        :class="{ 'is-invalid': form.errors.has('fullname')}">
                  </div>
                  <div class="col-xs-6 form-group">
                     <label>Course</label>
                     <input v-model="form.course" 
                        type="text" name="course"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('course') }">
                  </div>
                  <div class="col-xs-6 form-group">
                    <label>Picture</label>
                    <input class="form-control" type="file" v-on:change="addImage">
                  </div>
                    <div class="col-xs-6 form-group">
                <label>Contact Number</label>
                <input v-model="form.contact" 
                type="text" 
                name="contact"
                class="form-control" 
                :class="{ 'is-invalid': form.errors.has('contact')}">
                </div>
                  <button type="submit" class="btn btn-block btn-success"> Submit</button>
                  <router-link to="/teachers" class="btn btn-block btn-danger">Back</router-link>
               </form>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   export default {
       data() {
           return {
           teachers: [],
               form: new Form({
                   fullname: '',
                   image: '',
                   course:'',
               })
           }
       },
       created() {
           this.teachers = this.$router.currentRoute.params
         //   console.log(this.teachers.id)
         //   console.log(this.teachers)
       },
       methods:{
          editTeacher(){
              this.form.put('/editTeacher/' +this.teachers.id)
                  .then(()=> {
                     console.log(this.teachers.id)
                        swal.fire("User Updated!", "", "success");
                  })
                  .catch(()=>{
                       swal.fire("Something Went Wrong", "", "error");
                   });
          },
          
            addImage(e){
                let file = e.target.files[0]
                // console.log(file)
                var reader = new FileReader()
                if(file['size'] < 2111775){
                    reader.onloadend =  (file)=>{
                    // console.log('RESULT', reader.result)
                    this.form.image = reader.result;
                    }
              reader.readAsDataURL(file);
            }
                else {
                    console.log('File too large')
                    }
            }
       }
   
   }
</script>