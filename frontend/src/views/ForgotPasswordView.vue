<template>
    <NavBar />
    <ForgotPassword />
</template>

<script>
import ForgotPassword from '../components/ForgotPassword.vue'
import NavBar from "../components/NavBar.vue";

export default ({
    name: 'ForgotPasswordView',
    components: {
        NavBar,
        ForgotPassword,
    },
})
</script>
