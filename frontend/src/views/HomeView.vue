<template>
  <div>
    <NavBar />

    <SearchBar />

    <PostList />
  </div>
</template>

<script>
import PostList from "../components/PostList.vue";
import SearchBar from "../components/SearchBar.vue";
import NavBar from "../components/NavBar.vue";

export default {
  name: "HomeView",
  components: {
    PostList,
    SearchBar,
    NavBar,
  },
};
</script>

<style scoped>


</style>