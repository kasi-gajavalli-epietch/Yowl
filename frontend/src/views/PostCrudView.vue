<template>
<div>
<NavBar />
<CrudPosts />
</div>
</template>

<script>
import CrudPosts from '../components/CrudPosts.vue'
import NavBar from '@/components/NavBar.vue'
export default {
    name: 'PostCrudView',
    components: {
    CrudPosts,
    NavBar
}

}
</script>

<style>

</style>