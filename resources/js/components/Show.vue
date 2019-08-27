<template>
    <div class="container">
    
           <div class="col-md-12">
             <p style="margin-left:75px;">
                 <button @click="editModal(posts)" class="btn btn-primary"> <i class="fa fa-edit"> </i> Edit</button>
                 <button @click="deletePost(posts.id)" class="btn btn-danger"> <i class="fa fa-trash"> </i> Delete</button>
             </p>
              <img class="img-responsive showImg" :src="'/img/post/'+posts.photo" alt="">
                        <hr/>

                        <div class="card-body tpBody">
                          <h3 class="">{{posts.title}}  </h3>
                            <p>
                                {{posts.body}} 
                            </p>
                        </div>

                        <div class="tpDate">
                            <small >Written On {{posts.created_at}} By {{posts.user_id}}</small>
                        </div>
          
          </div>
        <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPost">Add New Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form @submit.prevent="updatePost()">
            <div class="modal-body">
                <div class="form-group">  
                  <input v-model="form.title" type="text" name="title"
                    placeholder="Title"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                  <has-error :form="form" field="title"></has-error>
                </div>

                <div class="form-group">  
                  <textarea  v-model="form.body" name="body"
                    placeholder="Post Body"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('body') }">
                  </textarea> 
                  <has-error :form="form" field="body"></has-error>
                </div>

                <div class="form-group">
                        <label for="picture" class="col-sm-4 control-label">Add Photo: </label>

                        <div class="col-sm-10">
                          <input  type="file" @change="addPicture" name="picture"
                            placeholder="Choose Photo" class="form-input" :class="{ 'is-invalid': form.errors.has('picture') }">
                            <has-error :form="form" field="picture"></has-error>
                        </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
                
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
            id:this.$route.params.id,    
            posts:{},
            form: new Form({
            id:'',  
            title:'',  
            body:'',
            picture:''
          })
          }
        },

        methods:{
            deletePost(id){
              swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
              // Send request to the server
                  if (result.value) {
                     //axios.delete('posts/'+id)
                     axios.post('/posts/'+id,{_method: 'delete'})
                    .then(()=>{
                      swal.fire(
                      'Deleted!',
                      'The post has been deleted.',
                      'success'
                      )
                      this.$router.push('/');
                    }).catch(()=> {
                      swal.fire("Failed!", "There was something wrong.", "warning");
                    });
                  }
          })
        },

        editModal(posts){
          this.form.reset();
          
          $('#addPost').modal('show');
          this.form.fill(posts);
        },
        updatePost(){
          this.$Progress.start();

          this.form.put('/posts/'+this.form.id)
           .then(()=>{
            swal.fire(
              'Updated!',
              'The user has been updated.',
              'success'
              )
            Fire.$emit('afterCreate');
            $('#addPost').modal('hide');
            this.$Progress.finish();
           })
           .catch(()=>{
             swal.fire("Failed!", "There was something wrong.", "warning");
            this.$Progress.fail();
           })
          
        },

        addPicture(e){
            let file=e.target.files[0];
            console.log(file);
            let reader=new FileReader();

            if (file['size']<=2111775) {
            reader.onloadend=(file)=> {
            this.form.picture=reader.result;
            }
            reader.readAsDataURL(file);
            } 
            else {
                swal.fire(
                'Oops!',
                'you are uploading larger file than 2 MB ',
                'error'
                )
            }
        },
        loadPost(){
              axios.get('/posts/'+this.id).then(({data})=>(this.posts=data));
        }

        },

        created() {
           this.loadPost();
           Fire.$on('afterCreate',()=>{
            this.loadPost();
          });
           
        }
    }
</script>

