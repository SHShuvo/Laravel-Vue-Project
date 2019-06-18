<style>
.widget-user-header{
  background-position: center center !important;
  background-size: cover !important;
  min-height:230px;
}
widget-user-image{
  background-position: center center !important;
}
.widget-user .widget-user-image > img{
  width: 120px !important;
}

</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background: url('./img/cover.jpg') center center;">
                <h3 class="widget-user-username">Sajjad Hossain</h3>
                <h5 class="widget-user-desc">Web Developer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
               
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                    <div class="text-center">
                        <h2>Display Activity</h2>
                    </div>
                      
                  </div>
                  <!-- /.tab-pane -->
                  
                  
                  <!-- /.tab-pane -->

                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                         <input v-model="form.name" type="text" name="name"
                            placeholder="Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input v-model="form.email" type="text" name="email"
                            placeholder="Email Address"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="bio" class="col-sm-2 control-label">Bio</label>

                        <div class="col-sm-10">
                          <textarea v-model="form.bio" name="bio" id="bio"
                            placeholder="Bio for user"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"> </textarea>
                            <has-error :form="form" field="bio"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">User type</label>
                        <div class="col-sm-10">
                          <select v-model="form.type" name="type" id="type" placeholder="Select User Role"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option value=''>Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">Standard User</option>
                            <option value="author">Author</option>
                          </select>
                           <has-error :form="form" field="type"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>

                        <div class="col-sm-10">
                          <input  type="file" @change="updateProfile" name="photo"
                            placeholder="Choose File" class="form-input" :class="{ 'is-invalid': form.errors.has('photo') }">
                            <has-error :form="form" field="photo"></has-error>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="password" class="col-sm-8 control-label">Password (leave empty if not changing)</label>

                        <div class="col-sm-12">
                                    <input type="password"
                                        v-model="form.password"
                                        class="form-control"
                                        name="password"
                                        id="password"
                                        placeholder="Password"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                    >
                                     <has-error :form="form" field="password"></has-error>
                                    </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" @click.prevent="updateInfo" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>

        </div>
    </div>
</template>

<script>
    export default {
      data(){
        
        return{
          
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

      mounted() {
          console.log('Component mounted.')
      },
      methods:{

        getProfilePhoto(){
          let photo=(this.form.photo.length>100)? this.form.photo: '/img/profile/'+this.form.photo;
          return photo;
        },
        updateInfo(){
          this.$Progress.start();

           this.form.put('api/profile')
           .then(()=>{


           this.$Progress.finish();
           })
           .catch(()=> {
           this.$Progress.fail();
           });
        },

        updateProfile(e){
         let file=e.target.files[0];
         console.log(file);
         let reader=new FileReader();

         if (file['size']<=2111775) {
           reader.onloadend=(file)=> {
           this.form.photo=reader.result;
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
         

        }

      },
      created() {
         axios.get("api/profile")
         .then(({data})=>(this.form.fill(data)));
      }
  }
</script>
