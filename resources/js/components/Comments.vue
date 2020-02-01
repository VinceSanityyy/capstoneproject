<template>
  <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
              <h3 class="box-title"> Comments </h3>
          </div>
           <div class="box-body">
                <table class="table table-hover" id="myTable">
                    <thead>
                         <tr>
                            <th>Teacher Name</th>
                            <th>Id Number</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="comment in comments" :key="comment.id">
                            <td>{{comment.name}}</td>
                            <td>{{comment.id_number}}</td>
                            <td>{{comment.comment}}</td>
                        
                        </tr>
                    </tbody>
                </table>

            </div>
      </div>
  </div>
</template>

<script>
import datatables from 'datatables'
    export default {
        data(){
            return{
                comments:[]
            }
        },
        methods:{
            getComments(){
                 axios.get('/getComments')
                    .then((res) => {
                        this.comments = res.data
                        this.myTable()
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            },
              myTable(){
        $(document).ready( function () {
              $('#myTable').DataTable();
          });
      }
        },
        created() {
            this.getComments()
            console.log('Component mounted.')
        }
    }
</script>
