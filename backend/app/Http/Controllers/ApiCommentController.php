<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;

class ApiCommentController extends Controller
{
    public function getComments()
    {
        $comments = Comment::get();

        return response()->json([
            'comments' => $comments
         ], 200);
    }

    public function getComment($id)
    {
        $comment = Comment::find($id);

        if($comment == null)
        {
            return response()->json([
                'message' => "Not found comment :("
             ], 404);
        }

        return response()->json([
            'comment' => $comment
         ], 200);
    }

    public function addComment(Request $request)
    {
        $user = User::find($request->user_id);

        if($user == null)
        {
            return response()->json([
                'message' => 'You are not connected :('
             ], 403);
        }

        $post = Post::find($request->post_id);

        if($post == null)
        {
            return response()->json([
                'message' => 'Not founded post :('
             ], 404);
        }
        
        $comment = new Comment;

        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;
        $comment->content = $request->content;

        $comment->save();

        return response()->json($comment, 200);
    }

    public function setComment(Request $request, $id)
    {
        $comment = Comment::find($id);

        if($comment == null)
        {
            return response()->json([
                'message' => "Not found comment :("
             ], 404);
        }
        
        if($request->user_id != $comment->user_id)
        {
            return response()->json([
                'message' => 'You have not the rights :('
            ], 403);
        }

        $comment->content = $request->content;
        $comment->post_id = $request->post_id;

        $comment->save();

        return response()->json($comment, 200);
    }

    public function delComment(Request $request, $id)
    {
        $user = User::find($request->user_id);

        if($user == null)
        {
            return response()->json([
                'message' => 'You are not connected :('
             ], 403);
        }
        
        $comment = Comment::find($id);

        if($comment == null)
        {
            return response()->json([
                'message' => "Not found comment :("
             ], 404);
        }

        if($user->is_admin == 0)
        {
            if($request->user_id != $comment->user_id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                    ], 403);
            }
        }

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted :)'
         ], 200);
    }

    public function commentsOfPost($id)
    {
        $comments = Comment::find($id);

        var_dump($comments->post);
    }
}