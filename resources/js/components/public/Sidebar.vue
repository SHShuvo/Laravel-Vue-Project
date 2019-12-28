<template>
    <div class="container">
        <div class="card">
            <h4 class="card-header">Top Stories</h4>
            <div class="card-header sbItem"  v-for="post in posts" :key="post.id">
                <router-link :to="'/show/'+post.id">{{post.title | postBody(50)}}</router-link>
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
