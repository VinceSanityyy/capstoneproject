<template>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Subject List</h3>
        <div class="box-tools">
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Add new<i class="fa fa-plus"></i></button>
         <button class="btn btn-info pull-right" data-toggle="modal" data-target="#exampleModal2">Import <i class="fa fa-book"></i></button>
        </div>
      </div>
      <div class="box-body">
          <table class="table table-hover" id="myTable">
            <thead>
               <tr>
                      <!-- <th>ID</th> -->
                      <th>Subject Code</th>
                       <th>Subject Description</th>
                      <th>Actions</th>
                  </tr>
            </thead>
              <tbody>
                 
                  <tr v-for="subjectcode in subjectcodesData" :key="subjectcode.id">
                      <!-- <td>{{subjectcode.id}}</td> -->
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
         <!-- <pagination :data="subjectcodes" @pagination-change-page="getSubjectCodes"></pagination> -->
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
          <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Import CSV</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <form @submit.prevent="importSubject()">
                <div class="modal-body">
                    <div class="form-group">
                      <label>Select CSV</label>
                      <input
                        @change ="loadCSV"
                        type="file"
                        id="file"
                        name="file"
                      />
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Import</button>
                </div>
                </form>
              </div>
            </div>
          </div>
    </div>
  </div>
</template>

<script>
import datatables from 'datatables'
	export default {
		data() {
			return {
				editmode: false,
        subjectcodes: {},
        subjectcodesData:[],
				form: new Form({
					id: '',
					subject_code: '',
					subject_description: ''
				})
			}
		},
		methods: {
			// getSubjectCodes(page) {
      //      if (typeof page === 'undefined') {
      //               page = 1;
      //           }
      //      axios.get('/getSubjectCodes?page=' + page)
      //              .then(data => {
      //                   this.subjectcodes = data.data;
      //               });
      // },
       myTable(){
        $(document).ready( function () {
              $('#myTable').DataTable();
          });
      },
        getSubjectCodesDataTable(){
           axios.get('/getSubjectCodesDatatable')
                            .then((res) => {
                                this.subjectcodesData = res.data
                                this.myTable()
                            })
                            .catch((e) => {
                                console.log(e)
                            })
      },
			newModal() {
				this.editmode = false
				this.form.reset()
				$('#exampleModal').modal('show')
			},
			createSubjectCode() {
				this.form.post('/addSubjectCode')
					.then(({
						data
					}) => {
						swal.fire("Subject Updated!", "", "success");
						$('#exampleModal').modal('hide');
						$(".modal-backdrop").remove();
						this.getSubjectCodesDataTable()
						console.log(data)
					})
			},
			editModal(subjectcode) {
				this.editmode = true
				this.form.reset()
				$('#exampleModal').modal('show')
				this.form.fill(subjectcode)
			},
			updateSubjectCode() {
				this.form.put('/updateSubjectCode/' + this.form.id)
					.then(() => {
						swal.fire("Subject Updated!", "", "success");
						$('#exampleModal').modal('hide');
						$(".modal-backdrop").remove();
						this.getSubjectCodesDataTable()
					})
					.catch((e) => {
						console.log(e)
					})
			},
			deleteSubjectCode(id) {
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
						this.form.delete('deleteSubjectCode/' + id)
							.then(() => {
								this.getSubjectCodesDataTable()
								swal.fire("Deleted!", "", "success");
							})
							.catch(() => {
								//temp rani
								this.getSubjectCodesDataTable()
								swal.fire("Deleted!", "", "success");
							});

					}
				});
			},
			importSubject() {
				axios.post('/importSubject')
					.then(() => {
						console.log('imported')
					})
			},
			loadCSV(e) {
				const formData = new FormData();
				const file = e.target.files[0];
				formData.append('template', file);
				axios.post('/importSubject', formData)
					.then(response => {
						swal.fire("Records Imported!", "", "success");
						$('#exampleModal2').modal('hide');
						$(".modal-backdrop").remove();
						this.getSubjectCodesDataTable()
					})
					.catch(error => {
						swal.fire("Something went wrong.", "", "warning");
					});
			}

		},
		mounted() {
			console.log('Component mounted.')
			this.getSubjectCodesDataTable();
		}
	} 
  </script>
