<template>
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Subjects List</h3>
        <div class="box-tools">
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">Add new<i class="fa fa-plus"></i></button>
        </div>
      </div>
      <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
              <tbody>
                  <tr>
                      <th>Subject Code</th>
                      <th>Subject Name</th>
                      <th>Department</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
              </tbody>
          </table>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
