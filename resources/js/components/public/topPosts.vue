<template>
    <span>
        <div class="row">
            <div class="card" v-for="post in posts.slice(0,1)" :key="post.id">
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

        <div class=" row card pt-3">
            <div class="card spBody" v-for="post in posts.slice(1,5)" :key="post.id">
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
    </span>
</template>

<script>
    export default {
        data(){ 
            return{
            posts:[]
            
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            loadPosts(){
                axios.get('/posts').then(({data})=>(this.posts=data.data));
            },
        },

        created() {
            this.loadPosts();
        }
    }
</script>
