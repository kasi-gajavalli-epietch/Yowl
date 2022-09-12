<template>
<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="carte">
                    <div class="carte-header">
                        <h3 class="carte-title">{{this.posts.length + " Posts"}}</h3>
                    </div>
                    <div class="carte-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>User</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(post, index) in posts" :key="post.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ post.title }}</td>
                                    <td>{{ post.link }}</td>
                                    <td>{{ post.user_id }}</td>
                                    
                                    <td>
                                        <button class="btn btn-danger" @click="delPost(post.id)">Delete</button>
                                    </td>
                                    

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</template>

<script>
import axios from 'axios'
export default {
    name: "CrudPosts",
    data() {
        return {
            posts: [],
        };
    },
    created() {
    },
    methods: {
        
        async getPosts() {
            await axios.get("http://127.0.0.1:8000/api/posts").then((response) => {
                this.posts = response.data.posts;
                console.log(this.posts);
            }).

            catch((error) => {
                console.log(error);
            })
        },
        
    async delPost(id) {
         if(confirm("Are you sure to delete this post ?"))
    {
      console.log(this.posts);
        await axios.post("http://127.0.0.1:8000/api/deletepost/" + id, {

        user_id: this.user_id,

      }).then((response) => {
       this.getPosts();
      })

      
    }
     },
     async getCurrentUser()
    {
        this.user_id = localStorage["user_id"];
    }
        
        },
       
        computed: {
            countPosts() {
                return this.posts.length;
            }
        },
    mounted() {
        console.log("component mounted");
        this.getPosts();
        this.getCurrentUser();
        
    },
}
</script>

<style scoped>
.carte {
    margin-top: 20px;
}
.carte-header {
    padding: 10px 15px;
    border-bottom: 1px solid #f4f4f4;
    background-color: #fff;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    text-align: center;
}
.carte-header h4 {
    margin: 0;
}
.carte-body {
    padding: 10px 15px;
    background-color: #fff;
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
}
.table-responsive {
    margin-bottom: 15px;
}
.table-responsive > .table {
    margin-bottom: 0;
}
.table-responsive > .table > thead > tr > th:first-child,
.table-responsive > .table > tbody > tr > th:first-child,
.table-responsive > .table > tfoot > tr > th:first-child,
.table-responsive > .table > thead > tr > td:first-child,
.table-responsive > .table > tbody > tr > td:first-child,
.table-responsive > .table > tfoot > tr > td:first-child {
    border-top-left-radius: 3px;
}
.table-responsive > .table > thead > tr > th:last-child,
.table-responsive > .table > tbody > tr > th:last-child,
.table-responsive > .table > tfoot > tr > th:last-child,
.table-responsive > .table > thead > tr > td:last-child,
.table-responsive > .table > tbody > tr > td:last-child,
.table-responsive > .table > tfoot > tr > td:last-child {
    border-top-right-radius: 3px;
}
.table-responsive > .table > tbody > tr > td {
    vertical-align: middle;
}
.table-responsive > .table tr {
    border-bottom: 1px solid #f4f4f4;
}
.table-responsive > .table tr:nth-child(2n) {
    background-color: #f4f4f4;
}
.table-responsive > .table tr:hover {
    background-color: #f5f5f5;
}
.table-responsive > .table tr > td {
    border-top: 1px solid #f4f4f4;
}
.table-responsive > .table tr > td:first-child {
    border-top: 0;
}
.table-responsive > .table tr > td:last-child {
    border-top: 0;
}
.table-responsive > .table tr > td:hover {
    background-color: #f5f5f5;
}
.table-responsive > .table tr > td.active {
    background-color: #f5f5f5;
}
.table-responsive > .table tr > td.success {
    background-color: #dff0d8;
}
.table-responsive > .table tr > td.info {
    background-color: #d9edf7;
}
.table-responsive > .table tr > td.warning {
    background-color: #fcf8e3;
}
.table-responsive > .table tr > td.danger {
    background-color: #f2dede;
}
.table-responsive > .table tr > td.active,
.table-responsive > .table tr > td.success,
.table-responsive > .table tr > td.info,
.table-responsive > .table tr > td.warning,
.table-responsive > .table tr > td.danger {
    color: #fff;
}
.table-responsive > .table tr > td.active:hover,
.table-responsive > .table tr > td.success:hover,
.table-responsive > .table tr > td.info:hover,
.table-responsive > .table tr > td.warning:hover,
.table-responsive > .table tr > td.danger:hover {
    background-color: #f5f5f5;
}
.table {
    text-align: center;
}
</style>