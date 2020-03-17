<template>
    <div class="col-xs-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Departments List</h3>
                 <div class="box-tools">
                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary pull-right">Add new <i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <table id="myTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Department Code</th>
                            <th>Department Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="department in departments" :key="department.department_id">
                            <td>{{department.department_code}}</td>
                            <td>{{department.department_name}}</td>
                            <td>
                            <a href="#" data-toggle="modal" data-target="#exampleModal" @click="editModal(department)">
                             <i class="fa fa-edit"></i>
                           </a>
                            <a href="#" @click="deleteDepartment(department.department_id)">
                            <i class="fa fa-trash text-red"></i>
                          </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent = "createDepartment">
            <div class="modal-body">
               <div class="form-group">
                      <label>Department Code</label>
                      <input
                        v-model="form.department_code"
                        type="text"
                        name="department_code"
                        placeholder="Department Code"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('department_code') }"
                      />
                      <has-error :form="form" field="department_code"></has-error>
                </div>

                <div class="form-group">
                      <label>Department Name</label>
                      <input
                        v-model="form.department_name"
                        type="text"
                        name="department_name"
                        placeholder="Department Name"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('department_name') }"
                      />
                      <has-error :form="form" field="department_name"></has-error>
                </div>

            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
import datatables from 'datatables'
    export default {
        data(){
            return{
                departments:[],
                editmode: false,
                form: new Form({
                    department_id:'',
                    department_code:'',
                    department_name:''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            createDepartment(){
                this.form.post('/addDepartment')
                    .then(({data})=>{
                        swal.fire('Record Created!', '','success')
                        $('#exampleModal').modal('hide');
                        $(".modal-backdrop").remove();
                        this.getDepartments()
                        console.log(data)
                    })
                    .catch((e)=>{
                        console.log(e)
                    })
            },
            getDepartments(){
                axios.get('/getDepartments')
                    .then((res)=>{
                        this.departments = res.data
                        this.myTable()
                    })
            },
            myTable(){
                $(document).ready( function () {
                $('#myTable').DataTable();
                    })
            },
            editModal(department){
                this.editmode = true
                this.form.reset()
                $('#exampleModal').modal('show');
                this.form.fill(department)
            },
            deleteDepartment(department_id){
                swal.fire({
					title: "Are you sure?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Yes, delete it!"
                }).then(result =>{
                    if(result.value){
                        this.form.delete('deleteDepartment/'+department_id)
                            .then(()=>{
                                swal.fire('Deleted!','','success')
                                this.getDepartments()
                            }).catch((e)=>{
                                console.log(e)
                            })
                    }
                })
            }
        },
        created(){
            this.getDepartments();
        }
    }
</script>
