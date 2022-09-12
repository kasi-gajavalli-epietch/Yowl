<template>

    <div class="container">
        <h1 style="text-align:center; font-size:5rem; padding:5rem;"> Admin Dashboard</h1>
        <div class="center">
            <div class="card-container">
                <router-link :to="{name: 'UserListing'}">
                    <div class="card 1">
                        <div class="card_image"><img src="https://images.unsplash.com/photo-1502630859934-b3b41d18206c?w=500&h=500&fit=crop" class="gallery-image" alt=""></div>
                        <div class="card_title title-white">
                            <p>All Users</p>
                            <h1>{{this.users.length + " Users"}}</h1>
                        </div>
                    </div>
                </router-link>

                <router-link :to="{name: 'PostsCrudView'}">
                    <div class="card 1">
                        <div class="card_image"><img src="https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=500&h=500&fit=crop" class="gallery-image" alt=""> </div>
                        <div class="card_title title-white">
                            <p>All Posts</p>
                            <h1>{{this.posts.length + " Posts"}}</h1>
                        </div>
                    </div>
                </router-link>
                <router-link :to="{name: 'CommentsCrudView'}">
                    <div class="card 1">
                        <div class="card_image"><img src="https://images.unsplash.com/photo-1511765224389-37f0e77cf0eb?w=500&h=500&fit=crop" class="gallery-image" alt=""></div>
                        <div class="card_title title-white">
                            <p>All Comments</p>
                            <h1>{{this.comments.length + " Comments"}}</h1>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
  <!-- <router-link :to="{name: 'newpost'}"> + new post </router-link> -->
</template>

<script>
import axios from 'axios'
export default {
name: "Dashboard",
data() {
        return {
            posts: [],
            users: [],
            comments: [],
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
        async getComments() {
            await axios.get("http://127.0.0.1:8000/api/comments").then((response) => {
                this.comments = response.data.comments;
                console.log(this.comments);
            }).

            catch((error) => {
                console.log(error);
            })
        },
        async getUsers() {
            await axios.get("http://127.0.0.1:8000/api/users").then((response) => {
                this.users = response.data.users;
                console.log(this.users);
            }).

            catch((error) => {
                console.log(error);
            })
        },
         async getCurrentUser()
    {
        this.user_id = localStorage["user_id"];
    }

},
computed: {
            countPosts() {
                return this.posts.length;
            },
            countUsers() {
                return this.users.length;
            },
            countComments() {
                return this.comments.length;
            },
        },
 mounted() {
        
        this.getPosts();
        this.getCurrentUser();
        this.getUsers();
        this.getComments();
        
    },
}
</script>

<style scoped>
/*My Modifications*/
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
.card-container {
    align-content: center;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    height: auto;
    width: 100%;
    background-color: white;
    padding-top:4rem;
    padding-bottom:4rem;
    
}
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

@media all and (max-width: 1000px) {
  .cards-list {
    /* On small screens, we are no longer using row direction but column */
    flex-direction: column;
  }
  .card-container{
    align-content: center;
    display:grid;
    grid-template-columns: auto;
    align-items: center;
    background-color: white;
    padding-top:4rem;
    padding-bottom:4rem;
  }
}
</style>