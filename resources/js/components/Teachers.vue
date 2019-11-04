<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Responsive Hover Table</h3>
                <div class="box-tools">
                    <button class="btn btn-danger pull-right" data-toggle="modal" data-target="#exampleModal">Add New <i class="fa fa-plus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Type</th>
                            <th>Department</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>183</td>
                            <td>John Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="label label-success">Approved</span></td>
                            <td>asd/td>
                                <td>183</td>
                                <td>John Doe</td>
                                <td>asdf</td>
                                <td><span class="label label-success">Approved</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Enter Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="">
                    <div class="modal-body">

                    <div class="form-group">
                     <label>First Name</label>
                     <input
                       v-model="form.name"
                       type="text"
                       name="firstname"
                       placeholder="First Name"
                       class="form-control"
                       :class="{ 'is-invalid': form.errors.has('firstname') }"
                     />
                     <has-error :form="form" field="firstname"></has-error>
                    </div>

                    <div class="form-group">
                     <label>Last Name</label>
                     <input
                       v-model="form.name"
                       type="text"
                       name="lastname"
                       placeholder="Last Name"
                       class="form-control"
                       :class="{ 'is-invalid': form.errors.has('lastname') }"
                     />
                     <has-error :form="form" field="lastname"></has-error>
                    </div>

                    <div class="form-group">
                     <label>Gender</label>
                     <select
                       v-model="form.type"
                       name="gender"
                       placeholder="Gender"
                       class="form-control"
                       :class="{ 'is-invalid': form.errors.has('gender') }"
                     >
                       <option >Male</option>
                       <option >Female</option>
                     </select>
                     <has-error :form="form" field="gender"></has-error>
                   </div>

                   <div class="form-group">
                    <label>Birthday</label>
                    <input
                      v-model="form.bday"
                      type="date"
                      name="lastname"
                      placeholder="Last Name"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('bday') }"
                    />
                    <has-error :form="form" field="bday"></has-error>
                   </div>

                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
      data(){
        return{
          form: new Form({
            firstname:'',
            lastname: "",
          }),
        }
      },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
