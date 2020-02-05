<template>
   <div class="col-xs-12">
       <div class="box box-danger">
           <div class="box-header">
               <h3 class="box-title">Enter teacher details</h3>
           </div>
           <div class="box-body">
               <form @submit.prevent = createTeacher>
                <div class="col-xs-6 form-group">
                <label>Name</label>
                <input v-model="form.fullname" 
                type="text" 
                name="fullname"
                class="form-control" 
                :class="{ 'is-invalid': form.errors.has('fullname')}">
                </div>
                 <div class="col-xs-6 form-group">
                <label>Department</label>
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
                 <div class="col-xs-6 form-group">
                     <label>ID Number</label>
                     <input v-model="form.id_number" 
                        type="text" name="id_number"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('id_number') }">
                  </div>
             <button type="submit" class="btn btn-block btn-success"> Submit</button>
             <router-link to="/teachers" class="btn btn-block btn-danger">Back</router-link>
               </form>
           </div>
            
       </div>
  
   </div>
   
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                form: new Form({
                    fullname: '',
                    image: '',
                    course:'',
                    contact:'',
                    id_number:''
                })
            }
        },
        methods:{
            createTeacher(){
                this.form.post('/addTeacher')
                    .then((data)=>{
                         swal.fire("Record Created!", "", "success");
                        this.$router.push({path: '/teachers'})
                    })
                    .catch((e)=>{
                        console.log(e)
                    })
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
        },
        created() {
            console.log('Component mounted.')
        }
    }
</script>
