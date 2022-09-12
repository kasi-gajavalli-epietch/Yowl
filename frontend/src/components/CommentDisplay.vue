<template>
<section>
  <div >
    <div class="container cards-container">
        <div class="flex-container" >
          <div style="display:block;">
            <div class="card-box">
            <div style="margin:2rem;">
              <h1 style="text-align:center;">Comments</h1>
                <div v-if="true">
                  <textarea type="text" class="input-card" placeholder="Add Comment" cols="0" rows="0" v-model="content"></textarea>
                  <div class="sub-btn" style="margin-left: auto; margin-right: 3rem;">
                    <button style="padding:0.2rem;" type="submit" class="btn btn-primary" v-on:click="addComment()">Submit</button>
                  </div>
                </div>
            </div>
          </div>
          <div style="overflow-y: scroll; height:80rem;">
            <div class="boucle" v-for="comment in this.comments" :key="comment.id">
              <div v-if="comment.post_id == this.$route.params.id">
                <div v-for="user in this.users" :key="user.id">
                  <div v-if="user.id == comment.user_id">
                      <div href="#" class="card-box">
                          <div type=image class="profile_img">{{ user.image }}</div>
                          <div class="card-text">
                              <div class="card-data">
                                <p class="data-text">Posted by:<strong> {{ user.name }}</strong></p>
                                <p>{{comment.created_at.substring(0,10)}}</p>
                              </div>
                          </div>
                          <div class="detail">
                            <p class="card-description">{{comment.content}}</p>
                          </div>
                          <div class="del-btn" style="margin-left: auto; margin-right: 3rem;">
                            <button class="size btn btn-danger" style="padding:0.2rem;" v-on:click="delcomment(comment.id)">Delete</button>
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
</section>
</template>

<script>
import axios from 'axios'

export default {
  name: 'CommentDisplay',
  //props: ["post_id", "content"],

  data() {
    return {
      comments: [],
      users: []
    }
    },
  created() {
    

  },
  methods: {

 async getComments() {
    await axios.get('http://127.0.0.1:8000/api/comments').then((response) => {
      this.comments = response.data.comments;
      //console.log(this.comments);
    }).

      catch((error) => {
          console.log(error);
      })
  },
  async getUsers() {
  await axios.get("http://127.0.0.1:8000/api/users").then((response) => {
      this.users = response.data.users;
      console.log(this.users);
  })
  },

  async addComment(){

     await axios.post("http://127.0.0.1:8000/api/addcomment/", {
      user_id: localStorage["user_id"],
      post_id: this.$route.params.id,
      content:this.content,
    }).then((response) => {
      console.log(response);
    })  
    .catch (error=> {
      console.log(error);
    });
    this.getComments();
  },

  async delcomment(id){
    if(confirm("Are you sure to delete this comment ?"))
    {
      console.log(this.comments);
      await axios.post("http://127.0.0.1:8000/api/delcomment/" + id, {
        user_id: localStorage["user_id"],
      }).then((response) => {
        console.log(response);
      })
      this.getComments();
    }
  }
  },
  
  mounted() {
    console.log('component mounted');
    this.getUsers();
    this.getComments();
  },
 
 
}
</script>
<style scoped>
*,
* ::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  box-sizing: border-box;
  font-family: Roboto, sans-serif;
  color: #333333;
  letter-spacing: 0.01rem;
}

a {
  text-decoration: none;
  color: inherit;
}

.main {
  width: 100%;
  min-height: 100vh;
  padding-bottom: 2rem;
  overflow: hidden;
  background-color: whitesmoke;
}

.container {
  max-width: 80rem;
  height: 100%;
  overflow: hidden;
  margin: 0 auto;
  display: flex;
  flex-flow: column;
  align-items: center;
  padding: 3rem 0;
}

.container .deco {
  height: 3rem;
  width: 23rem;
  filter: brightness(120%);
}

.flex-container {
  display: flex;
  justify-content: center;
  gap: 2rem;
  width: 100%;
}
.cards-container {
  padding: 2rem;
}

.card-box {
  display: flex;
  flex-flow: column;
  width: 36.3rem;
  background-color: white;
  font-size: 0.92rem;
  box-shadow: 0px 3px 4px gray;
}

.card-img {
  height: 23rem;
  color:pink;
}

.card-data,
.card-title,
.card-description {
  padding: 0 1.5rem;
}

.card-data {
  padding-top: 2rem;
  padding-bottom: 1.3rem;
  width: 100%;
  font-size: 1rem;
}

.card-data p {
  display: inline-block;
}

.text-right {
  margin-left: 9.4rem;
  margin-right: 1rem;
}

.autor {
  font-weight: bold;
}

.card-title {
  display: block;
  margin: 0;
  margin-bottom: 1.3rem;
  font-size: 1.5em;
  font-weight: bold;
}
.card-title:hover {
  background-color: rgb(205, 202, 202);
}

.card-description {
  font-size: 1.15rem;
  line-height: 1.7rem;
  padding-bottom: 2rem;
}

textarea{
  border:none;
  height: 100px;
  width: 100%;
  outline:none;
  padding: 2rem;
  margin-bottom:2rem;
}

@media all and (max-width: 1200px) {
  .card-box {
    width: 30rem;
  }

  .container {
    padding: 1%;
  }

  .card-data {
    display: flex;
    justify-content: space-between;
  }

  .text-right {
    margin: 0;
  }

  .card-img {
    height: 20rem;
  }
}

@media all and (max-width: 1000px) {
  .flex-container {
    flex-flow: column;
    justify-content: center;
    align-items: center;
    width: 80%;
  }

  .card-box {
    width: 100%;
  }

  .card-img {
    height: 27rem;
  }
}

@media all and (max-width: 550px) {
  .card-img {
    height: 20rem;
  }

  .data-text {
    font-size: 0.85rem;
  }

  .card-title {
    font-size: 1.2rem;
  }

  .card-description {
    font-size: 1rem;
  }
}


</style>
