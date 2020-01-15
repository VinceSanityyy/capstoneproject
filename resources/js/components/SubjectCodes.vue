<template>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Subject List</h3>
        <div class="box-tools">
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Add new<i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
              <tbody>
                  <tr>
                      <th>ID</th>
                      <th>Subject Code</th>
                       <th>Subject Description</th>
                      <th>Actions</th>
                  </tr>
                  <tr v-for="subjectcode in subjectcodes" :key="subjectcode.id">
                      <td>{{subjectcode.id}}</td>
                      <td>{{subjectcode.subject_code}}</td>
                       <td>{{subjectcode.subject_description}}</td>
                      <td>
                            <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(subjectcode)">
                             <i class="fa fa-edit"></i>
                           </a>
                            <a href="#" @click="deleteSubjectCode(subjectcode.id)">
                                <i class="fa fa-trash text-red"></i>
                            </a>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Add Code</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <form @submit.prevent="editmode ? updateSubjectCode() : createSubjectCode()">
                <div class="modal-body">
                    <div class="form-group">
                      <label>Subject Code</label>
                      <input
                        v-model="form.subject_code"
                        type="text"
                        name="subject_code"
                        placeholder="Subject Code"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('subject_code') }"
                      />
                      <has-error :form="form" field="subject_code"></has-error>
                    </div>
                     <div class="form-group">
                      <label>Subject Description</label>
                      <input
                        v-model="form.subject_description"
                        type="text"
                        name="subject_description"
                        placeholder="Subject Desc"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('subject_description') }"
                      />
                      <has-error :form="form" field="subject_description"></has-error>
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
          <!-- Modal -->
    </div>
  </div>
</template>

<script>
    export default {
        data(){
            return{
                editmode:false,
                subjectcodes: [],
                form: new Form({
                    id: '',
                    subject_code:'',
                    subject_description:''
                })
            }
        },
         methods:{
          getSubjectCodes(){
              axios.get('/getSubjectCodes')
                  .then((res)=>{
                    this.subjectcodes = res.data
                    // console.log(res)
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
          createSubjectCode(){
            this.form.post('/addSubjectCode')
              .then(({data})=>{
                 swal.fire("Subject Updated!", "", "success");
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
                this.getSubjectCodes()
                console.log(data)
              })
          },
          editModal(subjectcode){
            this.editmode = true
            this.form.reset()
            $('#exampleModal').modal('show')
            this.form.fill(subjectcode)
          },
          updateSubjectCode(){
            this.form.put('/updateSubjectCode/' + this.form.id)
              .then(()=>{
                 swal.fire("Subject Updated!", "", "success");
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
                this.getSubjectCodes()
              })
              .catch((e)=>{
                console.log(e)
              })
          },
          deleteSubjectCode(id){
             swal.fire({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
             }).then(result => {
              //send delete request
              if (result.value) {
              this.form.delete('deleteSubjectCode/' +id)
                .then(()=>{
                   this.getSubjectCodes()
                    swal.fire("Deleted!", "", "success");
                })
                 .catch(()=>{
                   //temp rani
                    this.getSubjectCodes()
                    swal.fire("Deleted!", "", "success");
                });
              
              }
          });
          }
        },
        mounted() {
            console.log('Component mounted.')
            this.getSubjectCodes();
        }
    }
</script>
