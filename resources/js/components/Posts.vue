<template>
    <div class="container-fluid">

       <div class="row mt-1">
           <div class="col-md-2 ">
           </div>    
          <div class="col-md-7 ">
              <div class="row">
                    <div class="card" v-for="post in topP()" :key="post.id">
                        <img class="img-responsive topPostImg" :src="'/img/post/'+post.photo" alt="">
                        <hr/>

                        <div class="card-body tpBody">
                          <router-link v-bind:to="'show/'+post.id"> <h3 class="">{{post.title}}  </h3> </router-link> 
                            <p>
                                {{post.body | postBody(310)}} 
                               <router-link v-bind:to="'show/'+post.id"> <button class="btn btn-outline-primary btn-sm">read more</button> </router-link> 
                            </p>
                        </div>

                        <div class="tpDate">
                            <small >Written On {{post.created_at}} By {{post.user_id}}</small>
                        </div>
                    </div>
              </div>
          </div>

          <div class="col-md-3">
                <!-- Search Widget -->
                <div class="card">
                    <h4 class="card-header">Top Stories</h4>
                    <div class="card-header sbItem"  v-for="(post) in posts" :key="post.id">
                        <router-link v-bind:to="'show/'+post.id"> <li>{{post.title | postBody(50)}}</li> </router-link>
                    </div>
                </div>

            </div>
       
        </div>

        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-7">
                <div class=" row card pt-3">
                    
                
                        <div class="card spBody" v-for="post in spP()" :key="post.id">
                            <div class="row">
                                <div class="col-md-12">
                                    <router-link v-bind:to="'show/'+post.id"><h5 class="">{{post.title}}  </h5></router-link>
                                </div>
                           
                        
                            <div class="col-md-5">
                                <img class="img-responsive spImg" :src="'/img/post/'+post.photo" alt="">
                                
                            </div>
                
                            <div class="col-md-7">
                                <p>
                                {{post.body | postBody(300)}} 
                                <router-link v-bind:to="'show/'+post.id"><button class="btn btn-outline-primary light btn-sm">read more</button></router-link>
                                </p> 
                            </div>
                            </div>
                            
                        </div>
                
                </div>
            </div>


            <div class="col-md-3">
            </div>
                      
                  
                   
        </div>
    </div>
</template>


<script>
    export default {
        data(){ 
            return{
            posts:[]
            
            }
        },
        methods:{
        loadPosts(){
            axios.get("posts").then(({data})=>(this.posts=data.data));
        },
        topP(){
         return this.posts.slice(0,1);
        },
        spP(){
         return this.posts.slice(1,5);
        }
        },

        created() {
            this.loadPosts();
        }
    }
</script>
