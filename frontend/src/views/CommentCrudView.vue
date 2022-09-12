<template>
<div>
  <NavBar />
  <CrudComments/>
  </div>
</template>

<script>
import CrudComments from '../components/CrudComments.vue'
import NavBar from '@/components/NavBar.vue'
export default {
  name: 'CommentCrudView',
  components: {
  CrudComments,
  NavBar
}

}
</script>

<style>

</style>