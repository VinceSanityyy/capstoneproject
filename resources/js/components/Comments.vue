<template>
  <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
              <h3 class="box-title"> Comments </h3>
          </div>
           <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            
                            <th>Teacher Name</th>
                            <th>Checker Id</th>
                            <th>Comment</th>
                        </tr>
                        <tr v-for="comment in comments" :key="comment.id">
                            <td>{{comment.name}}</td>
                            <td>{{comment.checker_id}}</td>
                            <td>{{comment.comment}}</td>
                        
                        </tr>
                    </tbody>
                </table>

            </div>
      </div>
  </div>
</template>

<script>
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
                    })
                    .catch((e) => {
                        console.log(e)
                    })
            }
        },
        created() {
            this.getComments()
            console.log('Component mounted.')
        }
    }
</script>
