<template>
  <div class="row">
        <div class="col-12">
            <div class="carte">
                <div class="carte-header">
                    <h4>Update User</h4>
                </div>
                <!--<div v-for="user in this.users" :key="user.id">
                    <div v-if="user.id == $route.params.id">-->
                        <div class="carte-body">
                            <form @submit.prevent="setUser()">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" v-model="this.request.newName">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" v-model="this.request.newEmail">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" class="form-control" v-model="this.request.newLocation">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Is admin</label>
                                            <input type="text" class="form-control" v-model="this.request.newIs_admin">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <br>
                                            <input type="radio" class="form-control" value="man" v-model="this.request.newGender" /><label>Man</label>
                                            <br>
                                            <input type="radio" class="form-control" value="woman" v-model="this.request.newGender" /><label>Woman</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <input type="date" class="form-control" v-model="this.request.newBirthdate">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>password</label>
                                            <input type="text" class="form-control" v-model="this.user.password">
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group">
                                            <label>picture</label>
                                            <input type="file" accept="image/*" v-on:change="uploadImage($event)" id="file-input">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-12 mb-2">
                                        <button type="submit" class="btn btn-primary" >Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <!--</div>
                </div>-->
            </div>
        </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
    name: "EditUsers",
    data() {
        return {
            request: {
                user_id: localStorage["user_id"],
                is_admin: localStorage["is_admin"],
                newIs_admin: 0,
                newName: '',
                newEmail: '',
                newLocation: '',
                newGender: '',
                newBirthdate: '',
                password: '',
                newPicture: ''
            }
        };
    },
    created() {
        this.getUser();
    },
    methods: {
        async getUser() {
            await axios.get("http://127.0.0.1:8000/api/users/"+this.$route.params.id+"?force=true").then((response) => {
                //this.request = response.data.user;
                //console.log(response.data.user);
                //this.user.password = "";
                this.request.newName = response.data.user.name;
                this.request.newEmail = response.data.user.email;
                this.request.newLocation = response.data.user.location;
                this.request.newIs_admin = response.data.user.is_admin;
                this.request.newGender = response.data.user.gender;
                this.request.newBirthdate = response.data.user.birthdate;
                this.request.newPicture = response.data.user.picture;
            });
        },
        catch(error) {
            console.log(error);
        
        },
       //function setUser to save the changes
        setUser()
        {
           axios.post("http://127.0.0.1:8000/api/setuser/" + this.$route.params.id +"?force=true", {
                user_id: this.request.user_id,       //Je suis cet id
                is_admin: this.request.is_admin,     //Je suis admin ou pas
                name: this.request.newName,
                email: this.request.newEmail,
                location: this.request.newLocation,
                gender: this.request.newGender,
                birthdate: this.request.newBirthdate,
                //password: this.request.password,
                picture: this.newPicture,
           } ).then((response) => {
                this.$router.push({ name: 'UserListing' })
                console.log(response);
            }).catch((error) => {
                console.log(error);
            });
                
        },
        
        uploadImage(event)
        {
            /*this.newPicture = new FormData();
            this.newPicture.append('name', 'my-picture');
            this.newPicture.append('file', event.target.files[0]);
            console.log(event.target.files[0]);*/

            let file = event.target.files[0];
            let reader  = new FileReader();

            reader.onloadend = () =>
            {
                //console.log('RESULT', reader.result)
                this.request.newPicture = btoa(reader.result);
                //console.log(this.newPicture);
            }

            reader.readAsBinaryString(file);
        }
    },

    mounted() {
        this.getUser();
    },


}
</script>

<style scoped>
.carte {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    margin-top: 30px;
    padding: 30px;
    
}
.carte-header {
    border-bottom: 1px solid #eee;
    margin-bottom: 30px;
    padding-bottom: 15px;
}
.carte-body {
    padding-top: 15px;

}
.form-group {
    margin-bottom: 1rem;
   
}
.col-12 {
    flex: 0 0 100%;
    max-width: 100%;
}




</style>