<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Rooms List</h3>
                <div class="box-tools">
                    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Add new<i class="fa fa-plus"></i></button>
                    <button class="btn btn-info pull-right" data-toggle="modal" data-target="#exampleModal2">Import <i class="fa fa-book"></i></button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            
                            <th>Room Name</th>
                            <th>Building</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="room in rooms.data" :key="room.id">

                            <td>{{room.room_desc}}</td>
                            <td>{{room.bldg}}</td>
                            <td>
                           <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(room)">
                             <i class="fa fa-edit"></i>
                           </a>
                            <a href="#" @click="deleteRoom(room.id)">
                            <i class="fa fa-trash text-red"></i>
                          </a>
                         </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <pagination :data="rooms" @pagination-change-page="getRooms"></pagination>
        </div>
        <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Add Room</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <form @submit.prevent="editmode ? updateRoom() : createRoom()">
                <div class="modal-body">
                    <div class="form-group">
                      <label>Room Name</label>
                      <input
                        v-model="form.room_desc"
                        type="text"
                        name="room_desc"
                        placeholder="Room Name"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('room_desc') }"
                      />
                      <has-error :form="form" field="room_desc"></has-error>
                    </div>
                    <div class="form-group">
                      <label>Building</label>
                      <input
                        v-model="form.bldg"
                        type="text"
                        name="bldg"
                        placeholder="Room bldg"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('bldg') }"
                      />
                      <has-error :form="form" field="bldg"></has-error>
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
                  <form @submit.prevent="importRoom()">
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
	export default {
		data() {
			return {
        rooms:{},
        template:'',
				form: new Form({
					id: '',
					room_desc: '',
          bldg: '',
				})
			}
		},
		methods: {
			getRooms(page) {
          if (typeof page === 'undefined') {
                    page = 1;
                }
           axios.get('/getRooms?page=' + page)
                   .then(data => {
                        this.rooms = data.data;
                    });
			},
			newModal() {
				this.editmode = false
				this.form.reset()
				$('#exampleModal').modal('show')
			},
			createRoom() {
				this.form.post('/addRoom')
					.then(({
						data
					}) => {
						swal.fire("Record Created!", "", "success");
						$('#exampleModal').modal('hide');
						$(".modal-backdrop").remove();
						this.getRooms()
						console.log(data)
					})
			},
			editModal(room) {
				this.editmode = true
				this.form.reset()
				$('#exampleModal').modal('show')
				this.form.fill(room)
			},
			updateRoom() {
				this.form.put('/updateRoom/' + this.form.id)
					.then(() => {
						swal.fire("Record Updated!", "", "success");
						$('#exampleModal').modal('hide');
						$(".modal-backdrop").remove();
						this.getRooms()
					})
					.catch((e) => {
						console.log(e)
					})
			},
			deleteRoom(id) {
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
						this.form.delete('deleteRoom/' + id)
							.then(() => {
								swal.fire("Deleted!", "", "success");
								this.getRooms()
							})
							.catch(() => {
								swal.fire("Something went wrong.", "", "warning");
							});
					}
				});
			},
			importRoom() {
				axios.post('/importRoom')
					.then(() => {
						console.log('imported')
					})
			},
			loadCSV(e) {
			 const formData = new FormData();
       const file = e.target.files[0];
       formData.append('template', file);
       axios.post('/importRoom', formData)
            .then(response => {
                swal.fire("Records Imported!", "", "success");
                $('#exampleModal2').modal('hide');
						    $(".modal-backdrop").remove();
								this.getRooms()
            })
            .catch(error => {
                   swal.fire("Something went wrong.", "", "warning");
            });
			}
		},
		created() {
			this.getRooms()
			console.log('Component mounted.')
		},
	} 
  </script>
