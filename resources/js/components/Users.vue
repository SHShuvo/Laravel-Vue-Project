<template>
    <div class="container">
       <div class="row mt-4" v-if="$gate.isAuthorOrAdmin()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Users Table</h3>

                <div class="card-tools">
                 <button class="btn btn-success" @click="newModal()">Add New
                     <i class="fas fa-user-plus"></i>
                 </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Registered At</th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="user in users.data" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name | uptext }}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.type | uptext}}</td>
                    <td>{{user.created_at|rdate}}</td>

                    
                    <td>
                        <button href="" @click="editModal(user)">
                            <i class="fa fa-edit text-blue"></i>
                        </button>  <span style="margin:0 3px; color:blue">|</span>

                        <button href="" @click="deleteUser(user.id)">
                            <i class="fa fa-trash text-red"></i>
                        </button>
                    </td>
                  </tr>

                </tbody></table>
              </div>
                 <div class="card-footer ">
                   <div class="float-right mr-4 mt-2">
                      <pagination :data="users" @pagination-change-page="getResults"> 
                       <span slot="prev-nav">&lt; Previous</span>
                       <span slot="next-nav"> Next &gt;</span>
                      </pagination>
                   </div>
                 </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
       
       <div class="row mt-4" v-if="!$gate.isAuthorOrAdmin()">
         <not-found> </not-found>  
       </div>

    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editMode" class="modal-title" id="addNew">Add New User</h5>
                <h5 v-show="editMode" class="modal-title" id="addNew">Update User Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form @submit.prevent="editMode? updateUser():createUser()">
            <div class="modal-body">
                <div class="form-group">  
                  <input v-model="form.name" type="text" name="name"
                    placeholder="Name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                  <has-error :form="form" field="name"></has-error>
                </div>

                <div class="form-group">  
                  <input v-model="form.email" type="text" name="email"
                    placeholder="Email Address"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                  <has-error :form="form" field="email"></has-error>
                </div>

                <div class="form-group">  
                  <textarea v-model="form.bio" name="bio" id="bio"
                    placeholder="Bio for user"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"> </textarea>
                  <has-error :form="form" field="bio"></has-error>
                </div>

                <div class="form-group">  
                  <select v-model="form.type" name="type" id="type"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                     <option value="">Select User Role</option>
                     <option value="admin">Admin</option>
                     <option value="user">Standard User</option>
                     <option value="author">Author</option>
                    </select>
                  <has-error :form="form" field="type"></has-error>
                </div>

                <div class="form-group">  
                  <input v-show="!editMode" v-model="form.password" type="password" name="password"
                    placeholder="Password"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                  <has-error :form="form" field="password"></has-error>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button v-show="!editMode" type="submit" class="btn btn-success">Create</button>
                <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
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
          editMode:false,
          users:{},
          form: new Form({
          id:'',  
          name:'',  
          email: '',
          password: '',
          type:'',
          bio:'',
          photo:''
          
         })
        }
      },

      methods: {
        getResults(page=1){
           axios.get('api/user?page='+page)
           .then( response=>{
             this.users=response.data;
           });
        },
        newModal(){
          this.editMode=false;
          this.form.reset();
         
          $('#addNew').modal('show');
        },

         editModal(user){
           this.editMode=true;
          this.form.reset();
          
          $('#addNew').modal('show');
          this.form.fill(user);
        },
        
        updateUser(){
          this.$Progress.start();

           this.form.put('api/user/'+this.form.id)
           .then(()=>{
            swal.fire(
              'Updated!',
              'The user has been updated.',
              'success'
              )
            Fire.$emit('afterCreate');
            $('#addNew').modal('hide');
            this.$Progress.finish();
           })
           .catch(()=>{
             swal.fire("Failed!", "There was something wrong.", "warning");
            this.$Progress.fail();
           })
        },

        deleteUser(id){
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
                    this.form.delete('api/user/'+id)
                    .then(()=>{
                      swal.fire(
                      'Deleted!',
                      'The user has been deleted.',
                      'success'
                      )
                      Fire.$emit('afterCreate');
                    }).catch(()=> {
                      swal.fire("Failed!", "There was something wrong.", "warning");
                    });
                  }
          })
        },

        loadUsers(){
          if(this.$gate.isAuthorOrAdmin()){
            axios.get('api/user').then(({data})=>(this.users=data));
          }
          
        },

        createUser(){
          this.$Progress.start();
          
          this.form.post('api/user')
          .then(()=>{
            Fire.$emit('afterCreate');
            $('#addNew').modal('hide');

            toast.fire({
              type: 'success',
              title: 'Created user successfully'
              })
            this.$Progress.finish();
            })
          .catch(()=>{
            
          })
          
        }
      },
      created() {
          Fire.$on('searching',()=>{
            let query=this.$parent.search;
            axios.get('api/findUser?q=' + query)
            .then((data)=>{
               this.users=data.data;
            })
            .catch()
          });
         this.loadUsers();
          Fire.$on('afterCreate',()=>{
            this.loadUsers();
          });
        // setInterval(()=>this.loadUsers(),3000); 
      }
    }
</script>
