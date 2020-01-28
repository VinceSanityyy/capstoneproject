<template>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Subjects List</h3>
        <div class="box-tools">
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Add new<i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
              <tbody>
                  <tr>
                      <!-- <th>ID</th> -->
                      <th>Subject Name</th>
                      <th>Actions</th>
                  </tr>
                  <tr v-for="subject in subjects" :key="subject.id">
                      <!-- <td>{{subject.id}}</td> -->
                      <td>{{subject.subject_name}}</td>
                      <td>
                            <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(subject)">
                             <i class="fa fa-edit"></i>
                           </a>
                           <a href="#" @click="deleteSubject(subject.id)">
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
                  <h4 class="modal-title" id="exampleModalLabel">Add Subject</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <form @submit.prevent="editmode ? updateSubject() : createSubject()">
                <div class="modal-body">
                    <div class="form-group">
                      <label>Subject Name</label>
                      <input
                        v-model="form.subject_name"
                        type="text"
                        name="subject_name"
                        placeholder="Subject Name"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('subject_name') }"
                      />
                      <has-error :form="form" field="subject_name"></has-error>
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
                subjects: [],
                form: new Form({
                    id: '',
                    subject_name:'',
                })
            }
        },
         methods:{
          getSubjects(){
              axios.get('/getSubjects')
                  .then((res)=>{
                    this.subjects = res.data
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
          createSubject(){
            this.form.post('/addSubject')
              .then(({data})=>{
                swal.fire("Created!", "", "success");
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
                this.getSubjects()
                console.log(data)
              })
          },
          editModal(subject){
            this.editmode = true
            this.form.reset()
            $('#exampleModal').modal('show')
            this.form.fill(subject)
          },
          updateSubject(){
            this.form.put('/updateSubject/' + this.form.id)
              .then(()=>{
                  swal.fire("Subject Updated!", "", "success");
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
                this.getSubjects()
              })
              .catch((e)=>{
                console.log(e)
              })
          },
          deleteSubject(id){
            swal.fire({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete!"
                }).then(result=>{
                    if(result.value){
                         this.form.delete('/deleteSubject/'+id)
                        .then(()=>{
                             this.getSubjects();
                             swal.fire("Deleted!", "", "success");
                            
                        })
                        .catch(()=>{
                              swal.fire("Something went wrong.", "", "warning");
                        })
                    }
                })
          }
        },
        mounted() {
            console.log('Component mounted.')
            this.getSubjects();
        }
    }
</script>
