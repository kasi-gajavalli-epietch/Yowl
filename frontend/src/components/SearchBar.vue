<template>
  <div class='wrapper'>
  <!-- <input type='search' class='search-input' placeholder="RECHERCHE"> -->
  <div class="slogan">
  <h1>YOWL COMMENT THE INTERNET</h1>
  
  </div>
  
  <div class="ajout">
    <button class="addpost"><router-link :to="{name: 'newpost'}"> + new post </router-link></button>
  </div>
</div>
</template>

<script>

export default {
    //
}
</script>

<style scoped>
.wrapper{
  display:grid;
  justify-content:center;
  /* width:100%;
  height:300px; */
  /* background-image: url(https://images.pexels.com/photos/357159/pexels-photo-357159.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2); */
  background-size: 1200px 450px;
  border-radius: 16px;
  
}
.search-input{
  width:40%;
  font-size:1.3rem;
  border:1px solid grey;
  border-radius:20px;
  padding: 5px 20px 2px;
  margin:auto;
  text-align: center;
 
}
.search-input:hover, .search-input:focus{
  outline:none;
  border:none;
  box-shadow: 0px 0px 3px black;
}
.slogan {
  display: flex;
  justify-content: center;
 
  
 

}
.slogan h1 {
 font-size: 3rem;
 color:white;
  text-shadow: 0px 0px 3px black;
}
.ajout {
  display: flex;
  justify-content: center ;
}
.addpost {
  
  margin-left: 20px;
  background-color: yellow;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 16px;
  height: 50px;
  width: auto;
}
.addpost:hover {
  background-color: white;
  color: black;
  border: 2px solid yellow;
}


</style>