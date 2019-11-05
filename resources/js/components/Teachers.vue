<template>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Teachers List</h3>
                <div class="box-tools">
                    <router-link to="/addteacher" class="btn btn-danger pull-right">Add New <i class="fa fa-plus"></i></router-link>
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

                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
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
