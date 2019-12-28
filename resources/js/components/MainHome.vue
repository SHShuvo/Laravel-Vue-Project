<template>
    <div class="container-fluid">
       <div class="row mt-1">
            <div class="col-md-2 ">
            </div>    
            <div class="col-md-7 ">
                <router-view :key="$route.fullPath"></router-view>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <h4 class="card-header">Top Stories</h4>
                    <div class="card-header sbItem"  v-for="post in posts" :key="post.id">
                        <router-link :to="'/show/'+post.id">{{post.title | postBody(36)}}</router-link>
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
            posts:[]
            
            }
        },
        methods:{
        loadPosts(){
            axios.get('/posts').then(({data})=>(this.posts=data.data));
        },
        },

        created() {
            this.loadPosts();
            Fire.$on('loadSidebar',()=>{
            this.loadPosts();
          });
        }
    }
</script>

