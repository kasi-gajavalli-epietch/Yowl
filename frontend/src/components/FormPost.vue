<template>
<div class="all">
    <h1></h1>
    <div class="FormPost">
        <form @submit.prevent="addPost">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" v-model="title" placeholder="Titre">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" v-model="description" placeholder="Description">
        </div>
        <div class="form-group">
            <label for="link">Lien</label>
            <input type="text" class="form-control" id="link" v-model="link" placeholder="Lien">
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="text" class="form-control" id="image" v-model="image" placeholder="Image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "FormPost",
    data() {
        return {
            title: '',
            description: '',
            link: '',
            image: ''
        };
    },
    methods: {
        addPost() {
            axios.post('http://127.0.0.1:8000/api/createpost/', {
                title: this.title,
                description: this.description,
                link: this.link,
                image: this.image,
                
               
                user_id: localStorage["user_id"],
            })
            .then(response => {
                 this.$router.push({ name: 'home' })
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
        },
    },


}
</script>

<style scoped>
.all {
 display: block;
 align-content: center;
 text-align: center;



}
.FormPost {
    margin: 0 auto;
    width: 50%;
    padding: 10px;
 

}


</style>