<template>
<!-- display all user.name -->
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="carte">
                    <div class="carte-header">
                        <h4 class="carte-title">{{ this.users.length + " Users"}}</h4>
                    </div>
                    <div class="carte-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Location</th>
                                    <th class="admin">Admin</th>
                                   
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    <tr v-for="user in this.users" :key="user.id">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.gender }}</td>
                                        <td>{{ user.location }}</td>
                                        <td>{{ user.is_admin }}</td>
                                        
                                        <td>
                                            <router-link :to='{ name:"EditUsers" , params:{ id:user.id } }' class="btn btn-primary">Edit</router-link>
                                            <button class="btn btn-danger" v-on:click="delUser(user.id)">Delete</button>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
    name: "CrudUsers",
    data() {
        return {
            users: [],
        };
    },
    created() {
    },
    methods: {
        async getUsers() {
            await axios.get("http://127.0.0.1:8000/api/users").then((response) => {
                this.users = response.data.users;
                console.log(this.users);
            }).

            catch((error) => {
                console.log(error);
            })
        },
        
    //function  delUser
     async delUser(id) {
         if(confirm("Are you sure to delete this user ?")){
        await axios.post("http://127.0.0.1:8000/api/deluser/" + id, {
            user_id: 0, 
            is_admin: 1

        } ).then((response) => {
            
                this.getUsers = response.data.users;
                
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
                this.getUsers();
         }
         
        },
        
        },
   computed: {
            countUsers() {
                return this.users.length;
            }
        },

    mounted() {
        console.log("component mounted");
        this.getUsers();
        
    },

     

}


</script>

<style scoped>
/* crud */
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