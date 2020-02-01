<template>
  <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
              <h3 class="box-title"> Comments </h3>
          </div>
           <div class="box-body">
                <table class="table table-hover" id="myTable">
                    <thead>
                         <tr>
                            <th>Teacher Name</th>
                            <th>Id Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="comment in comments" :key="comment.id">
                            <td>{{comment.name}}</td>
                            <td>{{comment.id_number}}</td>
                            <td>
                            <a href="#" data-toggle="modal" data-target="#editModal" @click="editModal(comment)">
                             <i class="fa fa-eye"></i>
                            </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
      </div>
        <!-- import modal -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">View Comment</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label>Comment</label>
                      <input
                        v-model="form.comment"
                        type="text"
                        name="comment"
                        disabled
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('comment') }"
                      />
                    </div>
                      <div class="form-group">
                      <label>Attached Picture</label>
                     <img :src="'img/'+form.picture" v-bind="form.picture" class="img-responsive pad">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info btn-block" data-dismiss="modal">Close</button>
                </div>
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
                comments:[],
                form: new Form({
                    comment:'',
                    picture:''
                })
            }
        },
        methods:{
            getComments(){
                 axios.get('/getComments')
                    .then((res) => {
                        this.comments = res.data
                        this.myTable()
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            },
        myTable(){
        $(document).ready( function () {
              $('#myTable').DataTable();
          });
      },
      editModal(comment) {
          	this.editmode = true
			this.form.reset()
            $('#editModal').modal('show')
			this.form.fill(comment)
			},
        },
        created() {
            this.getComments()
            console.log('Component mounted.')
        }
    }
</script>
