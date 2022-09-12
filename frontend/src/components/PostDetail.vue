<template>
<section>
    <div class="container cards-container">
        <h1>Latest News From This Post</h1>
        <img class="deco" src="https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fpluspng.com%2Fimg-png%2Fdivider-png-hd-divider-png-1589-304-1589.png&f=1&nofb=1">
        <div class="flex-container">
            <div v-for="post in this.posts" :key="post.id">
                <div v-if="post.id == this.$route.params.id">
                    <div v-for="user in this.users" :key="user.id">
                        <div v-if="user.id == post.user_id">
                            <div href="#" class="card-box">
                              <!--<img src="https://images.unsplash.com/photo-1570145820259-b5b80c5c8bd6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80" >-->
                              <img :src="`https://api.apiflash.com/v1/urltoimage?access_key=0f9dbd96392046419bb27278589c40d3&url=`+ post.link + '&width=400&height=760'" alt="" class="card-img" ><!--{{post.image}}-->
                              <div class="card-text">
                                  <div class="card-data">
                                    <p class="data-text">{{post.created_at.substring(0,10)}}</p>
                                    <p class="data-text text-right">Posted by <a href="#" class="autor">{{ user.name }}</a></p>
                                    <p class="data-text">{{countCommentsByPost(post)}} <strong>Comments</strong></p>
                                  </div>
                              </div>
                              <div class="detail">
                                  <h2 class="card-title">{{post.title}}</h2>
                                  <p class="card-description">{{post.description}}</p>
                              </div>
                              <div style="text-align:center; padding:2rem;">
                                <!--<a href={{post.link}}>Article Link</a>-->
                                <h2 style="text-align:center">Link to Article:</h2><br>
                                {{post.link}}
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
    components: {
    },
    props: ["ArticleId"],
   

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
        async getPost() {
            await axios.get("http://127.0.0.1:8000/api/posts/"+this.$route.params.id+"?force=true").then((response) => {
                this.posts = response.data;
                console.log(this.posts);
                console.log(post.link);
            });
        },
        async getUsers() {
            await axios.get("http://127.0.0.1:8000/api/users").then((response) => {
                this.users = response.data.users;
                console.log(this.users);
            })
        },
        
        catch(error) {
            console.log(error);
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
        
          countCommentsByPost(post) {
              let count = 0;
              this.comments.forEach(comment => {
                  if (comment.post_id == post.id) {
                      count++;
                  }
              });
              return count;
          },
    },
    computed: {
      countComments() {
        return this.comments.length;
      },
      },
    mounted() {
      console.log('component mounted');
      this.getPost();
      this.getUsers();
      this.getComments();
    }
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
  /*max-width: 80rem;
  height: 100%;*/
  height:auto;
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
  margin-top: 3rem;
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
  height: 63rem;
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
