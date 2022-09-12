<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class ApiSearchController extends Controller
{
    public function search($params)
    {
        $results = [];
        
        //var_dump($params);
        //recherche dans post, comment et user
        $posts = Post::where('title', 'LIKE', '%' . $params . '%')->get()->toArray();

        $tab = [];

        foreach($posts as $p)
        {
            array_push($tab, $p["title"]);
            //var_dump($p["title"]);
        }

        if($tab != [])
            $results["post_titles"] = $tab;

        $posts = Post::where('description', 'LIKE', '%' . $params . '%')->get()->toArray();

        $tab = [];

        foreach($posts as $p)
        {
            array_push($tab, $p["description"]);
            //var_dump($p["title"]);
        }

        if($tab != [])
            $results["post_description"] = $tab;

        /*var_dump($posts);

        if($posts == [])
        {
            return response()->json([
                'message' => 'Not found :('
             ], 404);
        }*/

        //////////////////////////////////////////////////////////////////////////////

        $comments = Comment::where('content', 'LIKE', '%' . $params . '%')->get()->toArray();

        $tab = [];

        foreach($comments as $c)
        {
            array_push($tab, $c["content"]);
            //var_dump($p["title"]);
        }

        if($tab != [])
            $results["comments"] = $tab;

        //var_dump($comments);

        //////////////////////////////////////////////////////////////////////////////

        $users = User::where('name', 'LIKE', '%' . $params . '%')->get()->toArray();

        $tab = [];

        foreach($users as $u)
        {
            array_push($tab, $u["name"]);
            //var_dump($p["title"]);
        }

        if($tab != [])
            $results["users"] = $tab;

        //////////////////////////////////////////////////////////////////////////////

        //$postsOfUser = Post

        //var_dump($list_users_id);

        if($results == [])
        {
            return response()->json([
                'message' => 'Not found :('
             ], 404);
        }

        else
        {
            return response()->json([
                'message' => $results
             ], 200);
        }
    }
}
