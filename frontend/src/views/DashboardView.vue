<template>
  <NavBar />
  <Dashboard/>
</template>

<script>
import Dashboard from '../components/Dashboard.vue'
import NavBar from '../components/NavBar.vue'
export default {
  name: 'DashboardView',
  components: {
    NavBar,
  Dashboard,
}

}
</script>

<style>

</style>