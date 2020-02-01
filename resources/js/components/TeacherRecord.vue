<template>
   <div class="row">
       <div class="col-xs-12">
           <div class="box box-danger">
              <div class="box-header">
                   <h3 class="box-title">View Attendance Summary</h3>
              </div>
              <div class="box-body">
               <form action="">
                   <div class="col-xs-4 form-group">
                        <label>Start Date</label>
                       <date-picker name="from" id="from" v-model="from" :config="options" ></date-picker>
                    </div>
                    <div class="col-xs-4 form-group">
                        <label>End Date</label>
                          <date-picker name="to" id="to" v-model="to" :config="options" ></date-picker>
                    </div>
               </form>
            </div>
            <div class="box-footer">
                  <a type="button" @click="generate()" >
                    <button  class="btn btn-info">
                        Show Report
                    </button>
                </a>
            </div>
           </div>
       </div>
       <div class="col-xs-12">
           <div class="box box-info">
            <div class="box-body">
                     <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Room</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                            <th>Round Number</th>
                            <th>Time Check</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="result in results" :key="result.id">
                            <td>{{result.created_at}}</td>
                            <td>{{result.subject_description}}</td>
                            <td>{{result.room_desc}}</td>
                            <td>{{result.start_time}}</td>
                            <td>{{result.end_time}}</td>
                            <td>{{result.round_no}}</td>
                            <td>{{result.time_check}}</td>
                            <td>{{result.remarks_desc}}</td>
                            <td>
                            <a href="#"  data-toggle="modal" data-target="#exampleModal" @click="editModal(result)">
                             <i class="fa fa-edit"></i>
                           </a>
                            </td>
                          
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
           </div>
       </div>
               <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Add Comment</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <form @submit.prevent="addComment()">
                <div class="modal-body">
                    <div class="form-group">
                      <label>Comment</label>
                      <input
                        v-model="form.comment"
                        type="text"
                        name="comment"
                        placeholder="Write Comment"
                        class="form-control"
                        :class="{ 'is-invalid': form.errors.has('comment') }"
                      />
                      <has-error :form="form" field="comment"></has-error>
                    </div>
                     <div class="form-group">
                      <label>Add Picture</label>
                        <input class="form-control" type="file" v-on:change="addImage">
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
</template>

<script>
    export default {
        data(){
            return{
                    results:[],

                    form: new Form({
                    checker_id: '',
                    picture:'',
                    comment: 'comment',
                    }),

                    from: new Date(),
                    options: {
                    format: 'YYYY-MM-DD',
                    showClear: true,
                    showClose: true,
                    },

                    to: new Date(),
                    options: {
                    format: 'YYYY-MM-DD',
                    showClear: true,
                    showClose: true,
                    },

                    
            }
        },
        created() {
            console.log('Component mounted.')
        },
        methods:{
            generate(){
                let params = { from: this.from, to: this.to };
                let paramString = new URLSearchParams(params);
                axios.get(`/generatePersonal?${paramString.toString()}`)
                    .then((res)=>{
                        this.results = res.data
                    })
            },
            addComment(){
                this.form.post('/addComment')
					.then(({
						data
					}) => {
						swal.fire("Comment Submitted!", "", "success");
						$('#exampleModal').modal('hide');
						$(".modal-backdrop").remove();
						console.log(data)
					})
            },
            	editModal(result) {
				        this.editmode = true
                this.form.reset()
                this.form.fill(result)
				$('#exampleModal').modal('show')
      },
        addImage(e){
                let file = e.target.files[0]
                var reader = new FileReader()
                if(file['size'] < 2111775){
                    reader.onloadend =  (file)=>{
                    this.form.picture = reader.result;
                    }
              reader.readAsDataURL(file);
            }
                else {
                    console.log('File too large')
                    }
            }
        }
    }
</script>
