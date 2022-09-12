<template>
<div>
<NavBar />
  <CrudUsers/>
  </div>
</template>

<script>
import CrudUsers from '../components/CrudUsers.vue'
import NavBar from '../components/NavBar.vue'

export default {
    name: 'CrudUser',
    components: {
    CrudUsers,
    NavBar
    
    },
   
}

</script>

<style>

</style>