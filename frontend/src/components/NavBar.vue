<template>
<div class="pinterest">
  <div class="left">
    <!-- <a href="#" class="logo"><i class="fab fa-pinterest"></i></a> -->
    <a href="#" class="logo">
    <div class="logo"><img src="../assets/owljess.png" width="80" height="80" alt=""></div>
    </a>

  </div>
  <div class="search">
    <i class="fas fa-search"></i>
    <input type="search" name="" placeholder="SEARCH" id="" v-model="this.wordSearched" v-on:keyup="search($event)">
  </div>
  <div class="right">
   <router-link :to="'/'" class="items"><i class="fas fa-home"></i></router-link>
   <router-link :to="'/dashboard'" class="items"><i class="far fa-address-card"></i></router-link>
    <div v-for="user in this.users" :key="user.id">
      <div class="avatar" >
        <router-link :to="{ name: 'ProfilePage', params: {id: user.id} }" class="items">
          <div class="img">
            <img v-bind:src="`data:image/png;base64,${this.profil_picture}`" alt="">
          </div>
        </router-link>
      </div>
    </div>
    <button v-if="isloggedIn()" class="btn btn-danger" v-on:click="logout()" >
      <div class="img_logout">
        <router-link :to="'/'" class="items1">
        <img src="../assets/logout.jpeg" width="60" height="60" />
        </router-link>
      </div>
    </button>
    <button v-else class="btn btn-primary" v-on:click="login()" >
      <div class="img_login">
        <router-link :to="'/login'" class="items1">
        <img src="../assets/login.jpg" width="60" height="60" />
        </router-link>
      </div>
    </button>
  </div>
</div>
<div class="navbar2">
  <div class="navbar2 elements" style="width: 100%;display:flex;background-color:white;">
    <div v-for="user in this.users" :key="user.id">
      <div class="avatar2" >
        <router-link :to="{ name: 'ProfilePage', params: {id: user.id} }" class="items">
          <div class="img">
            <img v-bind:src="`data:image/png;base64,${this.profil_picture}`" alt="">
          </div>
        </router-link>
      </div>
    </div>
   <router-link :to="'/'" class="items2"><i class="fas fa-home"></i></router-link>
   <router-link :to="'/dashboard'" class="items2"><i class="far fa-address-card"></i></router-link>
  </div>
</div>
</template>

<script>
import axios from 'axios'
export default {
  data(){
     return{  
        active: false,
        profil_picture: "",
        users: [],
        wordSearched: ""
     }
   },
   computed: {
    
    },  
    methods: {
      toggle () {
        this.active = !this.active
      },
      async getUser() {
        axios.get("http://127.0.0.1:8000/api/users/" + localStorage["user_id"]).then((response) => {
          //console.log(response.data.user.picture);
          this.profil_picture = response.data.user.picture;
          //console.log(this.profil_picture);
        })
        
        //console.log(localStorage["user_id"]);
        await axios.get("http://127.0.0.1:8000/api/users/" + localStorage["user_id"], {
            user_id: localStorage["user_id"], 
        }).then((response) => {
            this.users = [ response.data.user ];
        }).catch((error) => {
            console.log(error);
        });
            //this.getUser();
      },

      isloggedIn(){
        console.log(localStorage.getItem("user_id") != null)
        return localStorage.getItem("user_id") != null;
      },
      logout(){
        localStorage.removeItem('user_id');
        console.log("logout")
        window.location.reload('http://localhost:8080/')

      },
      login(){
        console.log("login()")
      },

      search(event)
      {
        //console.log("http://127.0.0.1:8000/api/search/" + this.wordSearched);

        axios.get("http://127.0.0.1:8000/api/search/" + this.wordSearched).then((response) => {
          //console.log(response);
        });
      }
    },
    mounted(){
        this.getUser();
    }
  }
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-size: 1rem;
  
}
body {
  background: #f6f6f6;
}
* a {
  text-decoration: none;
  color: #151515;
}
.img_login{
  padding-left: 20px;
}
.pinterest {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #fff;
  padding: 0.938rem;
  border-radius: 16px;
}
.left {
  display: flex;
  align-items: center;
  width: 20%;
}
.left .logo {
  border-radius: 50%;
  width: 3rem;
  height: 3rem;
  display: flex;
  align-items: center;
  justify-content: center;
}
.left .logo:hover {
  background-color: #e5e5e5;
}
.left .logo i {
  color: #e60022;
  font-size: 24px;
}
.left .home {
  font-weight: bold;
  height: 3rem;
  color: #fff;
  padding: 1rem;
  background-color: #151515;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 1.563rem;
}
.avatar {
  width: 3rem;
  height: 3rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.avatar .img {
  height: 2rem;
  width: 2rem;
  position: relative;
  border-radius: 50%;
  overflow: hidden;
}
.avatar .img img {
  position: absolute;
  object-fit: cover;
  width: 100%;
  height: 100%;
}
.logo {
  width: 3rem;
  height: 3rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.logo .img {
  height: 3rem;
  width: 3rem;
  position: relative;
  border-radius: 50%;
  overflow: hidden;
}
.logo .img img {
  position: absolute;
  object-fit: cover;
  width: 100%;
  height: 100%;
}
.logotitle {
  width: 6rem;
  height: 2rem;
  border-radius: 20%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.logotitle .img {
  height: 3rem;
  width: 6rem;
  position: relative;
  border-radius: 20%;
  overflow: hidden;
}
.logotitle .img img {
  position: absolute;
  object-fit: cover;
  width: 100%;
  height: 100%;
}

.search {
  width: 80%;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 3rem;
  border-radius: 25px;
  overflow: hidden;
  background: #e3e3e3;
}
.search:hover {
  background: #c9c9c9;
}
.search i {
  width: 3rem;
  height: 3rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #767676;
}
.search input {
  width: 100%;
  border: none;
  background: none;
  outline: none;
  padding-right: 1rem;
}
.search input::placeholder {
  color: #767676;
  font-size: 1rem;
}
.right {
  width: 20%;
  display: flex;
  align-items: center;
}
.items {
  border-radius: 50%;
  width: 3rem;
  height: 3rem;
  display: flex;
  align-items: center;
  justify-content: center;
}
.items:hover {
  background: #e5e5e5;
}
.items i {
  font-size: 1rem;
  color: #767676;
}
.items1 {
  border-radius: 50%;
  width: 3rem;
  height: 3rem;
  display: flex;
  align-items: center;
  justify-content: center;
}
.items1:hover {
  background: #e5e5e5;
}
.items1 i {
  font-size: 1rem;
  color: #767676;
}
.navbar2{
  visibility:hidden;
}
@media all and (max-width: 1200px){
  .navbar2{
    padding:2rem;
    visibility: visible !important;
    display:flex;
    justify-content: space-evenly;
  }
  .avatar{
    visibility:hidden;
  }
  .items{
    visibility:hidden;
  }
  .items2 {
  border-radius: 50%;
  width: 3rem;
  height: 3rem;
  display: flex;
  align-items: center;
  justify-content: center;
}
.items2:hover {
  background: #e5e5e5;
}
.items2 i {
  font-size: 1rem;
  color: #767676;
}
.avatar2 {
  width: 3rem;
  height: 3rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  border:2px solid pink;
}
.avatar2 .img {
  height: 2rem;
  width: 2rem;
  position: relative;
  border-radius: 50%;
  overflow: hidden;
}
.avatar2 .img img {
  position: absolute;
  object-fit: cover;
  width: 100%;
  height: 100%;
}

}

</style>
