<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Teachers List</h3>
                <div class="box-tools">
                    <router-link to="/addteacher" class="btn btn-danger pull-right">Add New <i class="fa fa-plus"></i></router-link>
                 <button class="btn btn-info pull-right" data-toggle="modal" data-target="#exampleModal2">Import <i class="fa fa-book"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="myTable" class="table table-hover">
                    <thead>
                         <tr>
                            <!-- <th>ID</th> -->
                            <th>Picture</th>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="teacher in teachers" :key="teacher.id">
                            <!-- <td>{{teacher.id}}</td> -->
                            <td><img  :src="'img/'+teacher.image" class="img-rounded"  height="42" width="42"/></td>
                            <td>{{teacher.id_number}}</td>
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
         <!-- import modal -->
          <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Import CSV</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <form @submit.prevent="importTeacher()">
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
</template>

<script>
	import datatables from 'datatables'
export default {
	data() {
		return {
			teachers: '',
			form: new Form({
				id: ''
			})
		}
	},
	created() {
		this.getTeachers()
		// console.log('Component mounted.')
	},
	methods: {
		getTeachers() {
			axios.get('getTeachers')
				.then((res) => {
					this.teachers = res.data
					this.myTable()
					// this.sortData()
				})
				.catch((e) => {
					console.log(e)
				})
		},
		myTable() {
			$(document).ready(function () {
				$('#myTable').DataTable();
			});
		},
		editTeacher(data) {
			this.$router.push({
				name: 'EDITTEACHER',
				params: data
			})
		},

		deleteTeacher(id) {
			swal.fire({
				title: "Are you sure?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Delete!"
			}).then(result => {
				if (result.value) {
					this.form.delete('/deleteTeacher/' + id)
						.then(() => {
							this.getTeachers();
							swal.fire("Deleted!", "", "success");

						})
						.catch(() => {
							swal.fire("Something went wrong.", "", "warning");
						})
				}
			})
		},
		importTeacher() {
			axios.post('/importTeacher')
				.then(() => {
					console.log('imported')
						this.myTable()
				})
		},
		loadCSV(e) {
			const formData = new FormData();
			const file = e.target.files[0];
			formData.append('template', file);
			axios.post('/importTeacher', formData)
				.then(response => {
					swal.fire("Records Imported!", "", "success");
					$('#exampleModal2').modal('hide');
					$(".modal-backdrop").remove();
					// this.getRooms()
						this.myTable()
				})
				.catch(error => {
					swal.fire("Something went wrong.", "", "warning");
				});
		},
		// sortData(){
		//     $(document).ready( function () {
		//         $('#myTable').DataTable();
		//     } );
		// }
	}
} 
</script>
