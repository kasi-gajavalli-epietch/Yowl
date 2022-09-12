<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class ApiPostController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {
        $posts = Post::get();

        return response()->json([
            'posts' => $posts
         ], 200);
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPost($id)
    {
        $post = Post::find($id);

        return response()->json([
            'post' => $post
         ], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPost(Request $request)
    {
        $user = User::find($request->user_id);

        if($user == null)
        {
            return response()->json([
                'message' => "You are not connected :("
             ], 403);
        }

        $posts = Post::select('*')->where('link', $request->link)->get()->toArray();

        if($posts != [])
        {
            return response()->json([
                'message' => "This link already exists :("
             ], 403);
        }
        
        $post =  Post::create([
            'user_id'=>$request->user_id,
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$request->image,
            'link'=>$request ->link
        ]); 
       
        return response()->json($post, 201);
    }

    public function setPost(Request $request, $id)
    {
        $post = Post::find($id);

        if($post == null)
        {
            return response()->json([
                'message' => "Not found post :("
             ], 404);
        }

        $user = User::find($request->user_id);

        if($user == null)
        {
            return response()->json([
                'message' => "You are not connected :("
             ], 403);
        }

        if($user->is_admin == 0)
        {
            if($user->id != $post->user_id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                    ], 403);
            }
        }

        // On modifie le post
        $post->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$request->image,
            'link'=>$request ->link
        ]);

        return response()->json($post, 200);
    }

    public function deletePost(Request $request, $id)
    {
        $post = Post::find($id);

        if($post == null)
        {
            return response()->json([
                'message' => "Not found post :("
             ], 404);
        }

        $user = User::find($request->user_id);

        if($user == null)
        {
            return response()->json([
                'message' => "You are not connected :("
             ], 403);
        }

        if($user->is_admin == 0)
        {
            if($user->id != $post->user_id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                    ], 403);
            }
        }

        $post->delete();
        
        return response()->json([
            'message' => "Post deleted :)"
         ], 200);
    }

}
