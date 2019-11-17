<template>
   <div class="col-xs-12">
       <div class="box">
           <div class="box-header">
               <h3 class="box-title">Enter teacher details</h3>
           </div>
           <div class="box-body">
               <form @submit.prevent = createTeacher>

                <div class="col-xs-6 form-group">
                <label>First Name</label>
                <input v-model="form.firstname" 
                type="text" 
                name="firstname"
                class="form-control" 
                :class="{ 'is-invalid': form.errors.has('lastname')}">
                </div>
                
                <div class="col-xs-6 form-group">
                <label>Last Name</label>
                <input v-model="form.lastname" 
                type="text" name="lastname"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('lastname') }">
                </div>

                <div class="col-xs-6 form-group">
                <label>Gender</label>
                <select class="form-control"
                v-model="form.gender"
                :class="{ 'is-invalid': form.errors.has('gender') }">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                </div>

                <div class="col-xs-6 form-group">
                <label>Birthday</label>
                <input class="form-control" 
                type="date" 
                v-model="form.birthday"
                :class="{ 'is-invalid': form.errors.has('birthday') }"/>
                </div>


                <div class="col-xs-3 form-group">
                <label>Age</label>
                <input  type="text"
                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                v-model="form.age"
                class="form-control "
                 :class="{ 'is-invalid': form.errors.has('age') }"/>
                </div>

                <div class="col-xs-4 form-group">
                <label>Type</label>
                <select class="form-control"
                v-model="form.type"
                 :class="{ 'is-invalid': form.errors.has('type') }">
                    <option >Master</option>
                    <option >Doctor</option>
                    <option >Degree</option>
                </select>
                </div>

                <div class="col-xs-3 form-group">
                <label>Department</label>
                <select class="form-control"
                v-model="form.department_id">
                    <option :value="department.id" v-for="department in departments" :key="department.id">{{department.department_code}}</option>
                </select>
                </div>

                <div class="col-xs-6 form-group">
                <label>Picture</label>
                <input class="form-control" type="file" v-on:change="addImage">
                </div>

                <div class="col-xs-4 form-group">
                <label>Status</label>
                <select v-model="form.status" class="form-control">
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>
                </select>
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
                departments:[],
                editmode: false,
                form: new Form({
                    firstname: '',
                    lastname: '',
                    birthday:'',
                    gender:'',
                    age: '',
                    type:'',
                    status:'',
                    image: '',
                    department_id: ''
                })
            }
        },
        methods:{
            getDepartments(){
                axios.get('/getDepartments')
                    .then((res)=>{
                        this.departments = res.data
                    })
                    .catch((e)=>{
                        console.log(e)
                    })
            },

            createTeacher(){
                this.form.post('/addTeacher')
                    .then((data)=>{
                        // console.log(data)
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
            this.getDepartments()
            // console.log('Component mounted.')
        }
    }
</script>
