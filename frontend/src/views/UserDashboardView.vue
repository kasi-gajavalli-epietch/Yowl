<template>
<NavBar />
    <CrudUserComments />
    <CrudUserPosts />
</template>

<script>
import axios from 'axios';
import NavBar from '../components/NavBar.vue'
import CrudUserComments from '../components/CrudUserComments.vue';
import CrudUserPosts from '../components/CrudUserPosts.vue' 


export default ({
    components: {
        NavBar,
        CrudUserComments,
        CrudUserPosts,
    }
})
</script>