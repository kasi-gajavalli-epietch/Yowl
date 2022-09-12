<template>
<div>
<NavBar />
  <ProfileDetail />
  </div>
</template>

<script>

import NavBar from "../components/NavBar.vue";
import ProfileDetail from "../components/ProfileDetail.vue";

export default {
    components: {
    NavBar,
    ProfileDetail,
    },
   
}
</script>