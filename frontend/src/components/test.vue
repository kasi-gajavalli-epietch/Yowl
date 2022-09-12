<template>
<div id="container">
     <body v-for="post in this.posts" :key="post.id">
	<article class="card"><img src="https://www.transparenttextures.com/patterns/asfalt-light.png" alt="thumbnail" class="thumbnail">
		<div class="cat-links"><a href="#">{{countCommentsByPost(post)}}</a></div>
		<div class="preview" id="box1">
		<h2><a href="#">{{(post.link.length>15) ? post.link.substring(0,14)+".." : post.link}}</a></h2>
			<p>{{post.description}} <a href="#" class="moremore"></a></p>
			<a href="#" id="rm">read more</a>
	</div>
	</article>
    </body>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "PostList",
  data() {
    return {
      posts: [],
      comments: [],
      
    };
  },
  created() { 
  },
  methods: {
    async getPosts() {
      await axios.get("http://127.0.0.1:8000/api/posts").then((response) => {
        this.posts = response.data.posts;
        console.log(this.posts);
      });
    },
    catch(error) {
      console.log(error);
    },
    mounted() {

      this.getPosts();
    },

async getComments() {
            await axios.get("http://127.0.0.1:8000/api/comments").then((response) => {
                this.comments = response.data.comments;
                console.log(this.comments);
            }).

            catch((error) => {
                console.log(error);
            })
        },
        
          countCommentsByPost(post) {
              let count = 0;
              this.comments.forEach(comment => {
                  if (comment.post_id == post.id) {
                      count++;
                  }
              });
              return count;
          },
 },

  computed: {
            countComments() {
                return this.comments.length;
            },
    },
    
  mounted() {
    console.log("component mounted");
    this.getPosts();
    this.getComments();
  
   
  }
};
</script>

<style >

body {
	margin:0;
	padding:0;
	font-family:"helvetica neue", arial, sans-serif;
	font-weight:400;
	background-color:#eee;
	transition:all 0.4s;
	height:150vh;
}

a {
	text-decoration:none;
	transition: all 0.2s;
}

#container  {
	display:grid;
	grid-template-columns: repeat(auto-fit,minmax(240px,1fr));
	grid-gap:30px;
	list-style:none;
	margin:0;
	padding:4vh;
}

.card {
	position:relative;
	border-radius:20px;
	transition: all 0.4s;
}

.card:hover img, .card:hover .preview{
	box-shadow:0px 0px 4px 0px rgba(0,0,0,0.6);
	transition:all 0.3s,box-shadow 0.3s;
}

img {
	border-radius:20px 20px 0 0;
	width:100%;
	height:25vh;
	object-fit:cover;
	box-shadow:0px 0px 3px 1px rgba(0,0,0,0.2);
}

.card:nth-child(3n) img {
	background-color: #154c79
;
}

.card:nth-child(3n - 2) img {
	background-color: #e28743
;
}

.card:nth-child(3n - 1) img {
	background-color: #76b5c5;
} 

.thumbnail {
	margin-bottom:-5px;
}

.preview {
	background-color:#fff;
	padding:0;
	margin:0;
	box-shadow:0px 0px 3px 1px rgba(0,0,0,0.2);
	border-radius:0 0 20px 20px;
	position:relative;
	height:18vh;
	min-height:6em;
	max-height:18vh;
	display:flex;
	flex-flow:column nowrap;
	transition: all 0.4s, max-height 0.4s;
}

.preview p {
	font-size:0.85em;
	display:block;
	flex:1 1 auto;
	margin:1px;
	padding:0.3em 0.7em 0.7em 0.7em;
	z-index:0;
	overflow:hidden;
	border-radius:0 20px;
	transition:all 0.3s;
}

.preview::after {
	content: " ";
	display:block;
	background: rgb(255,255,255);
background: -moz-linear-gradient(180deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,1) 100%);
background: -webkit-linear-gradient(180deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,1) 100%);
background: linear-gradient(180deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff",endColorstr="#ffffff",GradientType=1);
	position:absolute;
	top:0;
	border-radius:0 0 20px 20px;
	left:0;
	z-index:1;
	width:100%;
	height:100%;
}

.preview > a {
	text-shadow:0px 0px 2px #fff,0px 0px 5px #fff;
	position:absolute;
	z-index:8;
	bottom:0;
	left:0;
	display:block;
	text-align:center;
	width:100%;
	box-sizing:border-box;
	padding:0.2rem;
	color:#14b840;
	text-decoration:none;
	font-weight:700;
	font-size:0.8em;
	letter-spacing: 1px;
	text-transform: uppercase;
	opacity:0.7;
}

.preview > a:hover {
	opacity:1;
}


h2 {
	padding:0;
	margin:0;
}

h2 a{
	color:#777;
	border-top:5px solid #ddd;
	border-bottom:5px solid #ddd;
	font-size:1.2rem;
	display:block;
	padding:0.2rem 10px;
	box-shadow:0px 0px 3px 1px rgba(0,0,0,0.3);
	margin:0 -7px;
	z-index:4;
	position:relative;
	background-color:#fff;
	font-weight:500;
}



h2 a:hover {
	margin:0 -10px;
	padding:0.2rem 13px;
	color:#555;
	box-shadow:0px 0px 5px 1px rgba(0,0,0,0.3);
	letter-spacing:0.02em;
}

h2 a::before {
	content: " ";
	display:block;
	position:absolute;
	bottom:100%;
	height:25vh;
	width:100%;
}

.cat-links {
	position:absolute;
	top:7px;
	right: 10px;
	text-align:center;
}

.cat-links a {
	color:#bbb;
	background-color:#fff;
	padding:2px 10px;
	display:inline-block;
	font-size:0.7em;
	font-weight:700;
	text-transform:uppercase;
	letter-spacing:2px;
	border-radius:20px;
}

.potato {
	height:auto;
	max-height:70vh;
	transition: all 0.6s, max-height 0.6s;
	padding-bottom:25px;
}

.potato::After {
	content:none;
}

.potato p {
	transition: all 0.6s;
	overflow:scroll;
}

.potato > a {
	border-top:#ddd solid 1px;
	color:#bbb;
}

.moremore {
	display:none;
	font-style:italic;
	color:#14b840;
	font-weight:700;
	opacity:0.7;
	transition: all 0.2s;
}

.moremore:hover {
	opacity:1;
}

.potato .moremore {
	display:inline;
}

.card:nth-child(3n - 2) h2 a{
	border-color:#46b8da;
}

.card:nth-child(3n - 1) h2 a {
	border-color:#ae5627  ;
}

.card:nth-child(3n) h2 a {
	border-color:#ea8841;
}
</style>
