<template>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Departments List</h3>
        <div class="box-tools">
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Add new<i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
              <tbody>
                  <tr>
                      <th>Department Code</th>
                      <th>Department Name</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                  <tr v-for="department in departments" :key="department.id">
                      <td>{{department.department_code}}</td>
                      <td>{{department.department_name}}</td>
                      <td v-if="department.status == 1"><span  class="label label-success">Active</span></td>
                      <td v-if="department.status == 0"><span  class="label label-danger">Inactive</span></td>
                      <td>
                        <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(department)">
                        <i class="fa fa-edit"></i></a></td>
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
              <h4 class="modal-title" id="exampleModalLabel">Add Department</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <form @submit.prevent="editmode ? updateDepartment() : createDepartment()">
            <div class="modal-body">
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
                <div v-show="editmode" class="form-group">
                <label>Status</label>
                <select
                  v-model="form.status"
                  name="status"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('status') }"
                >
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
                <has-error :form="form" field="type"></has-error>
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
    export default {
      data(){
        return{
          departments: [],
          editmode: false,
          form: new Form({
            department_code: '',
            department_name: '',
            status: '',
            id: ''
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
        newModal(){
          this.editmode = false
          this.form.reset()
          $('#exampleModal').modal('show')
        },
        createDepartment(){
          this.form.post('/addDepartment')
            .then(({data})=>{
              $('#exampleModal').modal('hide');
              $(".modal-backdrop").remove();
              this.getDepartments()
              console.log(data)
            })
        },
        editModal(department){
          this.editmode = true
          this.form.reset()
          $('#exampleModal').modal('show')
          this.form.fill(department)
        },
        updateDepartment(){
          this.form.put('/updateDepartment/' + this.form.id)
            .then(()=>{
              $('#exampleModal').modal('hide');
              $(".modal-backdrop").remove();
                      this.getDepartments()
            })
            .catch((e)=>{
              console.log(e)
            })
        }
      },
        created() {
          this.getDepartments()
          console.log('Component mounted.')
        }
    }
</script>
