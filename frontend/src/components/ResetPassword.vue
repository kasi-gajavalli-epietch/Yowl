<template>
    <form @submit.prevent="handleSubmit">
        <h3>Reset Password</h3>
        <div class="form-group">
            <label>New Password </label>
            <input type="password" class="form-control" v-model="password" placeholder="New Password">
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" class="form-control" v-model="password_confirm" placeholder="Confirm New Password">
        </div>
        <button class="btn btn-primary btn-block">SUBMIT</button>

    </form>
</template>
<script>
import axios from 'axios'

export default ({
    name: ResetPassword,
    data(){
        return{
            password:'',
            password_confirm:'',
        }
    },
    methods :{
       async handleSubmit(){
        const response =await axios.post('reset', {
            password:this.password,
            password_confirm: this.password_confirm,
            token: this.$route.params.token
        });
        console.log(response);
        this.$router.push('login');
       }
    }
})
</script>
