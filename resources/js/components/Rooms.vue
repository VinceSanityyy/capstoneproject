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
                            <th>Room ID</th>
                            <th>Room Name</th>
                            <th>Room Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="room in rooms" :key="room.id">
                            <td>{{room.id}}</td>
                            <td>{{room.room_name}}</td>
                            <td>{{room.room_code}}</td>
                            <td v-if="room.status == 1"><span  class="label label-success">Active</span></td>
                            <td v-if="room.status == 0"><span  class="label label-danger">Inactive</span></td>
                            <td>
                           <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(room)">
                             <i class="fa fa-edit"></i>
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
                        v-model="form.room_name"
                        type="text"
                        name="room_name"
                        placeholder="Room Name"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('room_name') }"
                      />
                      <has-error :form="form" field="room_name"></has-error>
                    </div>
                    <div class="form-group">
                      <label>Room Code</label>
                      <input
                        v-model="form.room_code"
                        type="text"
                        name="room_code"
                        placeholder="Room Code"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('room_code') }"
                      />
                      <has-error :form="form" field="room_code"></has-error>
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
          editmode: false,
          rooms: [],
          form: new Form({
            id:'',
            room_code:'',
            room_name:'',
            status:''
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
                $('#exampleModal').modal('hide');
                $(".modal-backdrop").remove();
                this.getRooms()
              })
              .catch((e)=>{
                console.log(e)
              })
          }
        },
        created() {
            this.getRooms()
            console.log('Component mounted.')
        },
    }
</script>
