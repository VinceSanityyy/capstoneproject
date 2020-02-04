<template>
   <div class="col-xs-12">
      <div class="box">
         <div class="box-header">
            <h3 class="box-title">Pending Records</h3>
            <br>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4"  v-for="(checker, index) in checkers" :key="index.cid">
            <div class="box box-primary">
               <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" :src="'img/'+checker.image" style="max-width: 100%;height: 100px;"  alt="User profile picture">
                  <h3 class="profile-username text-center">{{checker.fullname}}</h3>
                  <p class="text-muted text-center">Department: {{checker.course}}</p>
                  
                  <ul class="list-group list-group-unbordered">
                     <li class="list-group-item">
                        <b>Subject Code</b> <a class="pull-right">{{checker.subject_code}}</a>
                     </li>
                     <li class="list-group-item">
                        <b>Subject Title</b> <a class="pull-right">{{checker.subject_description}}</a>
                     </li>
                     <li class="list-group-item">
                        <b>Room</b> <a class="pull-right">{{checker.room_desc}}</a>
                     </li>
                     <li class="list-group-item">
                        <b>Days</b> <a class="pull-right">{{checker.day}}</a>
                     </li>
                     <li class="list-group-item">
                        <b>Time</b> <a class="pull-right">{{checker.start_time}} - {{checker.end_time}}</a>
                     </li>
                  </ul>
                  <a href="#"  @click="editFirstRound(checker)" class="btn btn-primary btn-block">View First Round</a>
                  <button  @click="editSecondRound(checker)" class="btn btn-primary btn-block">View Second Round</button>
                  <button @click="editModal(checker)"  data-toggle="modal" data-target="#exampleModal" class="btn btn-info btn-block">Set Remarks</button>
               </div>
            </div>
         </div>
      </div>
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Set Overall Remarks</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <form @submit.prevent="setOverall()">
                  <div class="modal-body">
                     <div class="col-xs-12 form-group">
                        <label>Select Remarks</label>
                        <select class="form-control" name="remarks" v-model="form.overall">
                           <option :value="remark.id" v-for="remark in remarks" :key="remark.id">{{remark.remarks_desc}}</option>
                        </select>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button  type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- modal -->
   </div>
</template>
<script>
	export default {
		data() {
			return {
            editmode: false,
				checkers: [],
            remarks: [],
				form: new Form({
					id: '',
                    overall: '',
                    cid: '',
				}),
			}
		},
		methods: {
			getCheckers() {
				axios.get('/getCheckers')
					.then((res) => {
                        this.checkers = res.data
                        console.log(res)
					})
					.catch((e) => {
						console.log(e)
					})
			},
			editFirstRound(data) {
				this.$router.push({
					name: 'editFirst',
					params: data
				})
			},
			editSecondRound(data) {
				this.$router.push({
					name: 'editSecond',
					params: data
				})
			},
			setOverall() {
				this.form.put('/setOverall/' + this.form.cid)
					.then(() => {
						swal.fire("Record Updated!", "", "success");
						$('#exampleModal').modal('hide');
                        $(".modal-backdrop").remove();
                        console.log(this.form)
					})
					.catch((e) => {
						console.log(e)
					})
			},
			editModal(checker) {
				$('#exampleModal').modal('show')
				this.form.fill(checker)
            },
            getRemarks() {
			axios.get('/getRemarks')
				.then((res) => {
					this.remarks = res.data
				})
		    },
		},
	
		created() {
			this.getRemarks()
			this.getCheckers()
		}
	} 
</script>