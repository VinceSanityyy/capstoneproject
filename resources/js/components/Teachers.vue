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
            <div class="box-body table-responsive no-padding">
                <table id="myTable" class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Type</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="teacher in teachers" :key="teacher.id">
                            <td>{{teacher.id}}</td>
                            <td><img style=" border-radius: 50%;" :src="'img/'+teacher.image"  height="42" width="42"/></td>
                            <td>{{teacher.firstname}}</td>
                            <td>{{teacher.lastname}}</td>
                            <td>{{teacher.gender}}</td>
                            <td>{{teacher.birthday}}</td>
                            <td>{{teacher.age}}</td>
                            <td>{{teacher.type}}</td>
                            <td>{{teacher.department_name}}</td>
                            <td v-if="teacher.status == 1"><span  class="label label-success">Active</span></td>
                            <td v-else><span  class="label label-danger">Inactive</span></td>
                            <td><button @click="editTeacher(teacher)"> <i class="fa fa-edit"></i></button></td>
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
    // import datatables from 'datatables'
    export default {
      data(){
        return{
            teachers: '',
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
                        // this.sortData()
                    })
                    .catch((e)=>{
                        console.log(e)
                    })
            },
            editTeacher(data) {
                this.$router.push({ name: 'EDITTEACHER', params: data})
            }
            // sortData(){
            //     $(document).ready( function () {
            //         $('#myTable').DataTable();
            //     } );
            // }
        }
    }
</script>
