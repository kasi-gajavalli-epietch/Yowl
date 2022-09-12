<template>
<div>
    <div class="container">
        <div class="profile">
            <div><h1 style="padding:2rem;text-align:center;font-size:2rem;">Profile Page</h1></div>
            <div v-for="user in this.users" :key="user.id">
                <div v-if="user.id == this.$route.params.id">
                    <div style="display:flex; text-align:center; gap:3rem;">
                        <div class="profile-image" style="border-radius: 50%;border:1px solid gray;"><img style="margin:2rem; display: block; border-radius: 50%;" src={{user.picture}} /></div>
                        <div style="display:block; text-align:center;">
                            <div><p style="fontsize:20px;padding-top:2rem;"><strong>{{user.name}}</strong></p></div>
                            <div><p style="fontsize:20px;padding-top:0.6rem;padding-left:2rem;">  {{user.location}}</p></div>
                        </div>
                    </div>
                    <div style="display:flex; justify-content:space-between;padding:2rem;">
                        <div class="buttons">
                        <button class="btn btn-danger" v-on:click="delUser(user.id)">Delete My Profile</button>
                        </div>
                    </div>
                    <div class="user_details">
                        <div class="basic_info">
                            <div class="carte-body" style="width: 100%; display:flex; gap:2rem; justify-content:space-evenly;padding-bottom:4rem;">
                                <div>
                                    <form @submit.prevent="setUser()">
                                        <div class="row" style="padding:2rem;">
                                            <div class="col-12 mb-2" style="padding:0.5rem;">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" v-model="user.name" @input="listeners('newName')" />
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2" style="padding:0.5rem;">
                                                <div class="form-group" style="display:flex; gap:1rem;">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" v-model="user.email" @input="listeners('newEmail')" />
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2" style="padding:0.5rem;">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <input type="text" class="form-control" v-model="user.location" @input="listeners('newLocation')" />
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2" style="padding:0.5rem;">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <input type="text" class="form-control" v-model="user.gender" @input="listeners('newGender')" />
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2" style="padding:0.5rem;">
                                                <div class="form-group">
                                                    <label>Birthdate</label>
                                                    <input type="date" class="form-control" v-model="user.birthdate" @input="listeners('newBirthdate')" />
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2" style="padding:0.5rem;">
                                                <div class="form-group">
                                                    <label>Profile Picture</label>
                                                    <input type="file" accept="image/*" v-on:change="uploadImage($event)" id="file-input">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2" style="padding:0.5rem;">
                                                <div class="form-group">
                                                    <label>Click to change your password directly (Optional!)</label><br>
                                                    <input type="password" class="form-control" v-model="user.password" @input="listeners('newPassword')">
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                     <div><h4 style="text-align:center;">Click To Modify/ Update Your Specific Details</h4></div>
                                </div>
                                <div class="card-dashboard">
                                    <div class="card-container-title" style="padding: 3rem; text-align:center;font-size:20px;"><h4>YOUR DASHBOARD</h4></div>
                                    <div class="card-container">
                                        <div class="cards-list" style="overflow-y: scroll; height:30rem;">
                                            
                                            <!--<router-link :to="{name: 'UserDashboardView'}">-->
                                                <div class="card 1">
                                                    <div class="card_image"><img src="https://i.redd.it/b3esnz5ra34y.jpg" /></div>
                                                    <div class="card_title title-white">
                                                        <p>Your Posts</p>
                                                        <h1>{{countPostsByUser(user)}}</h1>
                                                    </div>
                                                </div>

                                            <!--</router-link>-->
                                            <!--<router-link :to="{name: 'UserDashboardView'}">-->
                                                <div class="card 1">
                                                    <div class="card_image"> <img src="https://images.unsplash.com/photo-1488628075628-e876f502d67a?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=&bg=" /> </div>
                                                    <div class="card_title title-white">
                                                        <p>Your Comments</p>
                                                        <h1>{{countCommentsByUser(user)}}</h1>
                                                    </div>
                                                </div>
                                            <!--</router-link>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'ProfileDetail',

    data() {
        return {
        users: [],
        posts: [],
        comments: [],
        }
    },
    methods:{
        async getUser() {
            await axios.get("http://127.0.0.1:8000/api/users/"+this.$route.params.id, {
             user_id: localStorage["user_id"], 
        }).then((response) => {
            response.data.user.birthdate = new Date(response.data.user.birthdate)
            this.users = [ response.data.user ];
        }).catch((error) => {
            console.log(error);
        });
        },

        //function  delUser
     async delUser(id) {
         if(confirm("Are you sure to delete your profile? You wil be no longer logged in!!")){
        await axios.post("http://127.0.0.1:8000/api/deluser/" + id, {
            user_id: this.$route.params.id, 
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
       listeners(change){
            if (change == 'newName')
                axios.post("http://127.0.0.1:8000/api/setusername/" + this.$route.params.id +"?force=true", {
                    user_id: localStorage["user_id"],
                    is_admin: localStorage["is_admin"],
                    newName: this.users[0].name,
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
            else if (change == 'newEmail')
                axios.post("http://127.0.0.1:8000/api/setuseremail/" + this.$route.params.id +"?force=true", {
                    user_id: localStorage["user_id"],
                    is_admin: localStorage["is_admin"],
                    newEmail: this.users[0].email,
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
            else if (change == 'newLocation')
                axios.post("http://127.0.0.1:8000/api/setuserlocation/" + this.$route.params.id +"?force=true", {
                    user_id: localStorage["user_id"],
                    is_admin: localStorage["is_admin"],
                    newLocation: this.users[0].location,
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
            else if (change == 'newGender')
                axios.post("http://127.0.0.1:8000/api/setusergender/" + this.$route.params.id +"?force=true", {
                    user_id: localStorage["user_id"],
                    is_admin: localStorage["is_admin"],
                    newGender: this.users[0].gender,
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
            else if (change == 'newBirthday')
                axios.post("http://127.0.0.1:8000/api/setuserlocation/" + this.$route.params.id +"?force=true", {
                    user_id: localStorage["user_id"],
                    is_admin: localStorage["is_admin"],
                    newBirthday: this.users[0].birthday,
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
            if (change == 'newPassword')
                axios.post("http://127.0.0.1:8000/api/setuserlocation/" + this.$route.params.id +"?force=true", {
                    user_id: localStorage["user_id"],
                    is_admin: localStorage["is_admin"],
                    newPassword: this.users[0].password,
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
        },
        uploadImage(event)
        {
            let file = event.target.files[0];
            let reader  = new FileReader();
            reader.onloadend = () =>
            {
                //console.log('RESULT', reader.result)
                this.request.newPicture = btoa(reader.result);
                //console.log(this.newPicture);
            }
            reader.readAsBinaryString(file);
            axios.post("http://127.0.0.1:8000/api/setuserpicture/" + this.$route.params.id +"?force=true", {
                user_id: localStorage["user_id"],
                    is_admin: localStorage["is_admin"],
                    newPicture: this.users[0].picture,
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
        },
        async getPosts() {
            await axios.get("http://127.0.0.1:8000/api/posts").then((response) => {
                this.posts = response.data.posts;
                console.log(this.posts);
            }).

            catch((error) => {
                console.log(error);
            })
        },
        async getComments() {
            await axios.get("http://127.0.0.1:8000/api/comments").then((response) => {
                this.comments = response.data.comments;
                console.log(this.comments);
            }).

            catch((error) => {
                console.log(error);
            })
        },
        async getComments() {
            await axios.get("http://127.0.0.1:8000/api/comments").then((response) => {
                this.comments = response.data.comments;
                console.log(this.comments);
            }).

            catch((error) => {
                console.log(error);
            })
        },
            countPostsByUser(user) {
                let count = 0;
                this.posts.forEach(post => {
                    if (post.user_id == user.id) {
                        count++;
                    }
                });
                return count;
                },
            countCommentsByUser(user) {
                let count = 0;
                this.comments.forEach(comment => {
                    if (comment.user_id == user.id) {
                        count++;
                    }
                });
                return count;
            },
    },
    computed: {
            countPosts() {
                return this.posts.length;
            },
            countComments() {
                return this.comments.length;
            },
        },

    mounted(){
        this.getUser();
        this.getComments();
        this.getPosts();
    }
}
</script>
<style scoped>
:root {
    font-size: 10px;
}

*,
*::before,
*::after {
    box-sizing: border-box;
}
*body{
    background-color: #fff;
    font-family: "Open Sans", Arial, sans-serif;
    min-height: 100vh;
    background-color: #fafafa;
    color: #262626;
    padding-bottom: 3rem;
}

.container {
    max-width: 96rem;
    margin: 0 auto;
    padding: 0 2rem;
}
label{
    padding-right: 10px;
}
input{
    border: none;
    border-bottom:1px solid gray;
    padding-left: 10px;
    padding-top: 10px;
    margin-bottom: 10px;
    outline:none;
}
.card-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: auto;
    width: 100%;
    background-color: white;
}
.card-posts {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    width: 200px;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    cursor: pointer;
}
.card-posts:hover {
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
}
.card-comments {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    width: 200px;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    cursor: pointer;
}
.card-comments:hover {
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
}
/*My Modifications*/
.cards-list {
  z-index: 0;
  width: 90%;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.card {
  margin: 30px auto;
  width: 300px;
  height: 300px;
  border-radius: 40px;
box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
  cursor: pointer;
  transition: 0.4s;
}

.card .card_image {
  width: inherit;
  height: inherit;
  border-radius: 40px;
}

.card .card_image img {
  width: inherit;
  height: inherit;
  border-radius: 40px;
  object-fit: cover;
}

.card .card_title {
  text-align: center;
  border-radius: 0px 0px 40px 40px;
  font-family: sans-serif;
  font-weight: bold;
  font-size: 30px;
  margin-top: -80px;
  height: 40px;
}

.card:hover {
  transform: scale(0.9, 0.9);
  box-shadow: 5px 5px 30px 15px rgba(0,0,0,0.25), 
    -5px -5px 30px 15px rgba(0,0,0,0.22);
}

.title-white {
  color: white;
}

.title-black {
  color: black;
}

@media all and (max-width: 900px) {
  .card-list {
    /* On small screens, we are no longer using row direction but column */
    flex-direction: column;
  }
  .carte-body{
    flex-direction:column;
    padding-bottom:4rem;
  }
}

</style>