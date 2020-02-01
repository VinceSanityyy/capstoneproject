<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Teachers List</h3>
                <div class="box-tools">
                    <router-link to="/addteacher" class="btn btn-danger pull-right">Add New <i class="fa fa-plus"></i></router-link>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="myTable" class="table table-hover">
                    <thead>
                         <tr>
                            <!-- <th>ID</th> -->
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="teacher in teachers" :key="teacher.id">
                            <!-- <td>{{teacher.id}}</td> -->
                            <td><img  :src="'img/'+teacher.image" class="img-rounded"  height="42" width="42"/></td>
                             <td>{{teacher.fullname}}</td>
                            <td>{{teacher.course}}</td>                
                            <td>
                            <a href="#" @click="editTeacher(teacher)"> <i class="fa fa-edit"></i></a>
                            <a href="#" @click="deleteTeacher(teacher.id)">
                                <i class="fa fa-trash text-red"></i>
                            </a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</template>


<script>
    import datatables from 'datatables'
    export default {
      data(){
        return{
            teachers: '',
             form: new Form({
                 id:''
             })
        }
      },
        created() {
            this.getTeachers()
            // console.log('Component mounted.')
        },
        methods:{
            getTeachers(){
                axios.get('getTeachers')
                    .then((res)=>{
                        this.teachers = res.data
                        this.myTable()
                        // this.sortData()
                    })
                    .catch((e)=>{
                        console.log(e)
                    })
            },
             myTable(){
                $(document).ready( function () {
                    $('#myTable').DataTable();
                });
            },
            editTeacher(data) {
                this.$router.push({ name: 'EDITTEACHER', params: data})
            },

            deleteTeacher(id){
                swal.fire({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete!"
                }).then(result=>{
                    if(result.value){
                         this.form.delete('/deleteTeacher/'+id)
                        .then(()=>{
                             this.getTeachers();
                             swal.fire("Deleted!", "", "success");
                            
                        })
                        .catch(()=>{
                              swal.fire("Something went wrong.", "", "warning");
                        })
                    }
                })
            }
            // sortData(){
            //     $(document).ready( function () {
            //         $('#myTable').DataTable();
            //     } );
            // }
        }
    }
</script>
