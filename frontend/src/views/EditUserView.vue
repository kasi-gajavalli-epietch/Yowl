<template>
  <NavBar />
  <EditUsers />
</template>

<script>
import NavBar from '../components/NavBar.vue';
import EditUsers from '../components/EditUsers.vue';
export default {
    name: 'EditUsersView',
    components: {
      NavBar,
      EditUsers,
    },
   

}
</script>

<style>

</style>