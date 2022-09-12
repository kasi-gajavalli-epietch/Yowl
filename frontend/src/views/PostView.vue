<script>
import PostDetail from "@/components/PostDetail.vue";
import CommentDisplay from "@/components/CommentDisplay.vue";
import NavBar from "@/components/NavBar.vue";

export default {
  name: "App",
  components: {
    NavBar,
    PostDetail,
    CommentDisplay,
    //NavBar
  },
};
</script>
<template>
  <div>
    <NavBar />
    <div class="container2 cards-container2">
      <div class="flex-container2">
        <PostDetail />
        <CommentDisplay />
      </div>
    </div>
  </div>
</template>

<style scoped>


html {
  box-sizing: border-box;
  font-family: Roboto, sans-serif;
  color: #333333;
  letter-spacing: 0.01rem;
}

.main {
  width: 100%;
  min-height: 100vh;
  padding-bottom: 2rem;
  overflow: hidden;
  background-color: whitesmoke;
}

.container2 {
  max-width: 80rem;
  height: 100%;
  overflow: hidden;
  margin: 0 auto;
  display: flex;
  flex-flow: column;
  align-items: center;
  padding: 3rem 0;
}

.container2 .deco {
  height: 3rem;
  width: 23rem;
  filter: brightness(120%);
}

.flex-container2 {
  display: flex;
  justify-content: center;
  gap: 2rem;
  margin-top: 3rem;
  width: 100%;
}
.cards-container2 {
  padding: 0rem;
}
@media all and (max-width: 1200px){
  .flex-container2 {
  display: block;
  justify-content: center;
  width: 100%;
}

}
</style>
