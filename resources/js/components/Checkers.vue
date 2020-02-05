<template>
   <div class="col-xs-12">
       <div class="box box-danger">
           <div class="box-header">
               <h3 class="box-title">Checkers List</h3>
           </div>
           <div class="box-body">
               <table class="table table-hover" id="myTable">
                   <thead>
                       <tr>
                           <th>Name</th>
                           <th>Id Number</th>
                           <th>Status</th>
                           <th>Actions</th>
                       </tr>
                   </thead>
                   <tbody>
                       <tr v-for="checker in checkers" :key="checker.id">
                           <td>{{checker.name}}</td>
                           <td>{{checker.idnum}}</td>
                           <td>{{checker.status}}</td>
                            <td>
                            <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(checker)">
                             <i class="fa fa-edit"></i>
                           </a>
                            </td>
                       </tr>
                   </tbody>
               </table>
           </div>
       </div>
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="updateCheckers()">
      <div class="modal-body">
           <div class="form-group">
                        <label>Set Status</label>
                        <select class="form-control" name="checker_status" v-model="form.checker_status" :class="{ 'is-invalid': form.errors.has('checker_status') }">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
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
                checkers:[],
                form: new Form({
                    id:'',
                    checker_status:'',
                })
            }
        },
        methods:{
            getCheckersList(){
                 axios.get('/getStudents')
                            .then((res) => {
                                this.checkers = res.data
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
      editModal(checkers) {
			
				this.form.reset()
				$('#exampleModal').modal('show')
				this.form.fill(checkers)
            },
        updateCheckers() {
				this.form.put('/updateChecker/' + this.form.id)
					.then(() => {
						swal.fire("Record Updated!", "", "success");
						$('#exampleModal').modal('hide');
						$(".modal-backdrop").remove();
						this.getCheckersList()
					})
					.catch((e) => {
						console.log(e)
					})
			},
        },
        created() {
            this.getCheckersList()
            console.log('Component mounted.')
        }
    }
</script>
