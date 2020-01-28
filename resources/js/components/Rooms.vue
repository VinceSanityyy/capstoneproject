<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Rooms List</h3>
                <div class="box-tools">
                    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Add new<i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <!-- <th>Room ID</th> -->
                            <th>Room Name</th>
                            <th>Building</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="room in rooms" :key="room.id">
                            <!-- <td>{{room.id}}</td> -->
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
    </div>
</template>

<script>
    export default {
      data(){
        return{
          editmode: false,
          rooms: [],
          form: new Form({
            id:'',
            room_desc:'',
            bldg:'',
          })
        }
      },
        methods:{
          getRooms(){
              axios.get('/getRooms')
                  .then((res)=>{
                    this.rooms = res.data
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
          createRoom(){
            this.form.post('/addRoom')
              .then(({data})=>{
                swal.fire("Record Created!", "", "success");
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
                this.getRooms()
                console.log(data)
              })
          },
          editModal(room){
            this.editmode = true
            this.form.reset()
            $('#exampleModal').modal('show')
            this.form.fill(room)
          },
          updateRoom(){
            this.form.put('/updateRoom/' + this.form.id)
              .then(()=>{
                  swal.fire("Record Updated!", "", "success");
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
                this.getRooms()
              })
              .catch((e)=>{
                console.log(e)
              })
          },
          deleteRoom(id){
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
              this.form.delete('deleteRoom/' +id)
                .then(()=>{
                    swal.fire("Deleted!", "", "success");
                    this.getRooms()
                })
                .catch(()=>{
                    swal.fire("Something went wrong.", "", "warning");
                });
              }
          });
          }
        },
        created() {
            this.getRooms()
            console.log('Component mounted.')
        },
    }
</script>
