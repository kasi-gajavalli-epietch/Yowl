<template>
  <div class="header">
    <!--<h1>WELCOME TO YOWL</h1>-->
    <br /><br /><br /><br /><br />
    <div class="container">
      <div class="form">
        <h1>Join us</h1>
        <img src="../assets/owljess.png" width="120" height="120" />
        <div class="input">
          <label for="name" class="label">First name</label>
          <input
            v-model="this.firstname"
            type="text"
            name="user-name"
            class="form-input field"
            placeholder="Email"
            required
          />
        </div>
        <div class="input">
          <label for="email" class="label">Name</label>
          <input
            v-model="this.name"
            type="text"
            name="email"
            class="form-input field"
            id="email"
            placeholder="Email"
            required
          />
        </div>
        <br />
        <div class="input">
          <label for="text" class="label">Birthday</label>
          <input
            v-model="this.birthdate"
            type="date"
            name="dob"
            class="form-input field"
            id="DOB"
            placeholder="Date of Birth"
            required
          />
        </div>
        <div class="input" >
          
          <!--<label for="email" id="email_label" class="label">Gender</label>
          <input
            v-model="this.gender"
            type="radio"
            name="email"
            class="form-input"
            id="email"
            placeholder="Email"
            required
          />-->
          <div>
          <div style="position: relative; display:flex; ">
            <label for="text" class="label">Gender</label>
            <input
              type="radio"
              id="huey"
              name="drone"
              value="man"
              v-model="this.gender"
            />
            <label for="huey">Man</label>
            <input
              type="radio"
              id="dewey"
              name="drone"
              value="woman"
              checked
              v-model="this.gender"
            />
            <label for="dewey">Woman</label>
          </div>
          </div>
        </div>
        <div class="input">
          <label for="email" class="label">Location</label>
          <input
            v-model="this.location"
            type="text"
            name="email"
            class="form-input field"
            id="email"
            placeholder="Email"
            required
          />
        </div>

        <div class="input">
          <label for="email" id="email_label" class="label">Email</label>
          <input
            v-model="this.email"
            type="email"
            class="form-input field"
            id="email"
            placeholder="Email"
            required
          />
        </div>
        <div class="input">
          <input
            v-model="this.password"
            type="password"
            class="form-input field"
            placeholder="Password"
            id="password"
            required
          />
          <label for="password" class="label">Confirm your password</label>
          <input
            v-model="this.confirm_password"
            type="password"
            class="form-input field"
            placeholder="Password"
            id="password"
            required
          />
        </div>

        <div class="button">
          <div>
            <button type="submit" v-on:click="this.create()" id="submit_button">
              Ok :)
            </button>
          </div>
          <br />
        </div>
      </div>
    </div>

    <!--Waves Container-->
    <div>
      <svg
        class="waves"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28"
        preserveAspectRatio="none"
        shape-rendering="auto"
      >
        <defs>
          <path
            id="gentle-wave"
            d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
          />
        </defs>
        <g class="parallax">
          <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
          <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
          <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
          <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
        </g>
      </svg>
    </div>
    <!--Waves end-->
  </div>
</template>

<script>
//import { defineComponent } from '@vue/composition-api'
import axios from "axios";

export default {
  name: "Signup",

  data() {
    return {
      firstname: "Jessica",
      name: "Jouvencel",
      email: "jess@jess.com",
      birthdate: "Birthday",
      password: "1234",
      confirm_password: "1234",
      picture: "profil_photo",
      gender: "woman",
      location: "Marseille",
    };
  },

  methods: {
    create() {
      axios
        .post("http://localhost:8000/api/register", {
          name: this.name + " " + this.firstname,
          email: this.email,
          birthdate: this.birthdate,
          password: this.password,
          picture: this.picture,
          gender: this.gender,
          location: this.location,
        })

        .then((response) => {
          //console.log(response);
          localStorage["user_id"] = response.data.id;
          localStorage["is_admin"] = response.data.is_admin;
          this.$router.push({ name: "home" });
        });
      //console.log("OK");
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto:wght@100&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Square Peg", cursive;
  font-weight: 500;
}
.container {
  display: flex;
  justify-content: center;
  margin-bottom: 8vh;
}
p {
  text-align: center;
  margin: 0.5rem 0 1rem 0;
  font-size: 12px;
}
.fa-brands,
.fab {
  font-size: 27px;
  color: #588ce0;
}
.social-share a {
  text-decoration: none;
  color: #ce9461;
}
.fa-brands {
  width: 40px;
  padding: 0.3rem;
  height: 40px;
  border-radius: 50%;
}
.fa-google:hover,
.fa-facebook-f:hover {
  background-color: #5898fc;
  color: #ffff;
}
.form {
  background-color: #fff;
  height: auto;
  color: #000;
  padding: 3rem;
  margin-top: 2rem;
  border-radius: 20px;
}
.input {
  position: relative;
}
.label {
  position: absolute;
  top: 0;
  left: 0;
  transform: translate(20px, 20px);
  transform-origin: left;
  transition: transform 0.25s;
}
.form-input {
  transition: all 0.5s;
}
.field,
#password {
  padding: 10px;
  border: 1px solid #d3d3d3;
  border-radius: 4px;
  font: inherit;
  color: #000;
  background-color: transparent;
  margin: 15px;
}
.input:focus-within .label,
.form-input:not(:placeholder-shown) + .label {
  transform: translate(0, -12px) scale(0.8);
  color: #588ce0;
}
.input:focus-within #email,
.input:focus-within #password {
  outline-color: #588ce0;
}
.form-input::placeholder {
  color: transparent;
}
#submit_button {
  background-color: #588ce0;
  width: 100px;
  border: 1px solid #588ce0;
  border-radius: 25px;
  height: 30px;
  font-family: "Montserrat", sans-serif;
  font-weight: 900;
  color: #fcffe7;
  text-transform: uppercase;
}
h1 {
  font-family: "Montserrat", sans-serif;
  font-weight: 800;
  letter-spacing: 2px;
  font-size: 48px;
  text-transform: uppercase;
}
a {
  text-decoration: none;
  color: #588ce0;
}
.header {
  position: relative;
  text-align: center;
  background: linear-gradient(
    60deg,
    rgba(88, 152, 252, 100) 0%,
    rgba(247, 199, 99, 100) 100%
  );
  color: white;
}
.logo {
  width: 50px;
  fill: white;
  padding-right: 15px;
  display: inline-block;
  vertical-align: middle;
}

.inner-header {
  height: 65vh;
  width: 100%;
  margin: 0;
  padding: 0;
}

.flex {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.waves {
  position: relative;
  width: 100%;
  height: 15vh;
  margin-bottom: -7px;
  min-height: 100px;
  max-height: 150px;
}

.content {
  position: relative;
  height: 20vh;
  text-align: center;
  background-color: white;
}

.parallax > use {
  animation: move-forever 25s cubic-bezier(0.55, 0.5, 0.45, 0.5) infinite;
}
.parallax > use:nth-child(1) {
  animation-delay: -2s;
  animation-duration: 7s;
}
.parallax > use:nth-child(2) {
  animation-delay: -3s;
  animation-duration: 10s;
}
.parallax > use:nth-child(3) {
  animation-delay: -4s;
  animation-duration: 13s;
}
.parallax > use:nth-child(4) {
  animation-delay: -5s;
  animation-duration: 20s;
}
@keyframes move-forever {
  0% {
    transform: translate3d(-90px, 0, 0);
  }
  100% {
    transform: translate3d(85px, 0, 0);
  }
}
/*Shrinking for mobile*/
@media (max-width: 768px) {
  .waves {
    height: 40px;
    min-height: 40px;
  }
  .content {
    height: 30vh;
  }
  h1 {
    font-size: 24px;
  }
}
</style>
