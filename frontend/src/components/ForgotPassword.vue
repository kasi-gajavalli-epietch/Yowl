<template>
<div>
    <form @submit.prevent="handleSubmit">
        <h3>Forgot Password </h3>
        <div class="input">
            <input type="email" name="email" class="form-input" placeholder="Email" required  v-model="this.email" />
            <label for="email" id="email_label" class="label">Email</label>
        </div>
        <div class="button">
            <button type="submit" id="submit_button" @click="login()">SUBMIT</button>
        </div>
    </form>
</div>
    
</template>

<script>
import axios from 'axios';

export default ({
    name: 'ForgotPassword',
    data(){
        return{
            email:''
        } 
    },
    methods : {
        async handleSubmit(){
            const response= await axios.post('forgot',{
                email:this.email
            });
            console.log(response);

        }
    }
})
</script>
