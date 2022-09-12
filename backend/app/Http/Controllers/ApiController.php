<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Session\Session;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getUsers()
    {
        $users = User::get();

        foreach($users as $u)
        {
            $u["picture"] = base64_encode($u["picture"]);
        }

        return response()->json([
            'users' => $users
         ], 200);
    }

    public function getUser($id)
    {
        $user = User::find($id);

        $user["picture"] = base64_encode($user["picture"]);

        return response()->json([
            'user' => $user
         ], 200);
    }

    public function setUser($id, Request $request)
    {
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }
        
        $user = User::find($id);

        //var_dump($user);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        //$userArray = $user->toArray();

        //var_dump($userArray);

        $user->name = $request->newName;
        $user->email = $request->newEmail;
        $user->is_admin = $request->newIs_admin;
        $user->birthdate = $request->newBirthdate;
        /*if(isset($request->password))
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);*/
        $user->picture = $request->newPicture;
        $user->gender = $request->newGender;
        $user->location = $request->newLocation;

        $user->save();

        return response()->json([
            'message' => 'user updated :)'
         ], 200);
    }

    public function setUserName(Request $request, $id)
    {
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }
        
        $user = User::find($id);

        //var_dump($user);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        //$userArray = $user->toArray();

        //var_dump($userArray);

        $user->name = $request->newName;

        $user->save();

        return response()->json([
            'message' => 'Name updated :)'
         ], 200);
    }

    public function setUserEmail(Request $request, $id)
    {
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }
        
        $user = User::find($id);

        //var_dump($user);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        //$userArray = $user->toArray();

        //var_dump($userArray);

        $user->email = $request->newEmail;

        $user->save();

        return response()->json([
            'message' => 'Email updated :)'
         ], 200);
    }

    public function setUserPassword(Request $request, $id)
    {
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }
        
        $user = User::find($id);

        //var_dump($user);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        //$userArray = $user->toArray();

        //var_dump($userArray);

        $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);

        $user->save();

        return response()->json([
            'message' => 'Password updated :)'
         ], 200);
    }

    public function setUserGender(Request $request, $id)
    {
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }
        
        $user = User::find($id);

        //var_dump($user);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        //$userArray = $user->toArray();

        //var_dump($userArray);

        $user->gender = $request->newGender;

        $user->save();

        return response()->json([
            'message' => 'Gender updated :)'
         ], 200);
    }

    public function setUserLocation(Request $request, $id)
    {
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }
        
        $user = User::find($id);

        //var_dump($user);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        //$userArray = $user->toArray();

        //var_dump($userArray);

        $user->location= $request->newLocation;

        $user->save();

        return response()->json([
            'message' => 'Location updated :)'
         ], 200);
    }

    public function setUserAdmin(Request $request, $id)
    {
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }
        
        $user = User::find($id);

        //var_dump($user);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        //$userArray = $user->toArray();

        //var_dump($userArray);

        $user->is_admin= $request->newIs_admin;

        $user->save();

        return response()->json([
            'message' => 'Admin updated :)'
         ], 200);
    }

    public function setUserPicture(Request $request, $id)
    {
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }
        
        $user = User::find($id);

        //var_dump($user);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        //$userArray = $user->toArray();

        //var_dump($userArray);

        $user->picture= $request->newPicture;

        $user->save();

        return response()->json([
            'message' => 'Picture updated :)'
         ], 200);
    }

    public function delUser(Request $request, $id)
    {
        if(!isset($request->is_admin) || !isset($request->id))
        {
            return response()->json([
                'message' => 'You have not the rights :('
             ], 403);
        }
        
        if($request->is_admin == 0)
        {
            if($request->user_id != $id)
            {
                return response()->json([
                    'message' => 'You have not the rights :('
                 ], 403);
            }
        }

        $user = User::find($id);

        if($user == null)
        {
            return response()->json([
                'message' => 'bad user :('
             ], 400);
        }

        $user->delete();

        return response()->json([
            'message' => 'user deleted :)'
         ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = new User;
 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_BCRYPT);
        $user->is_admin = 0;
        $user->location = $request->location;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->picture = $request->picture;

        $birth = strtotime($user->birthdate);
        $now = strtotime("now");
        $interval = ($now - $birth)/(3600.0 * 24.0 * 365.24219879);

        if($interval < 13.0)
        {
            return response()->json([
                "message" => "user too young :("
            ], 403);
        }

        /*$token = "";

        for($i=0 ; $i<10 ; $i++)
        {
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $index = rand()%62;

            $token .= $caracteres[$index];
        }

        $user->remember_token = $token;*/
 
        $user->save();

        $session = new Session();

        $session->set('user',
        [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'birthdate' => $user->birthdate,
            'picture' => $user->picture,
            'gender' => $user->gender,
            'location' => $user->location,
            'is_admin' => $user->is_admin
        ]);

        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'birthdate' => $user->birthdate,
            'picture' => $user->picture,
            'gender' => $user->gender,
            'location' => $user->location,
            'is_admin' => $user->is_admin,
            //'remember_token' => $user->remember_token,
        ];

        return response()->json($user, 200);
    }

    public function getCurrentUser()
    {
        $session = new Session();
        
        return response()->json([
            'user' => $session->get('user')
         ], 200);
    }

    public function signin(Request $request)
    {
        $users = User::select('*')->where('email', $request->email)->get()->toArray();

        //var_dump($users[0]["name"]);
        //var_dump($users);

        // $response;
        // $code;

        if($users == [])
        {
            $response = [
                "message" => "bad user :("
            ];

            $code = 404;
        }
        else
        {
            if(!password_verify($request->password, $users[0]['password']))
            {
                $response = [
                    "message" => "Wrong password"
                ];
    
                $code = 403;
            }

            else
            {
                $response = [
                    'id' => $users[0]['id'],
                    'name' => $users[0]['name'],
                    'email' => $users[0]['email'],
                    'birthdate' => $users[0]['birthdate'],
                    'picture' => base64_encode($users[0]['picture']),
                    'gender' => $users[0]['gender'],
                    'location' => $users[0]['location'],
                    'is_admin' => $users[0]['is_admin'],
                    //'remember_token' => $users[0]['remember_token'],
                ];
    
                $code = 200;
            }
        }

        $session = new Session();

        $session->set('user',
        [
            'id' => $users[0]['id'],
            'name' => $users[0]['name'],
            'email' => $users[0]['email'],
            'birthdate' => $users[0]['birthdate'],
            'picture' => $users[0]['picture'],
            'gender' => $users[0]['gender'],
            'location' => $users[0]['location'],
            'is_admin' => $users[0]['is_admin']
        ]);

        return response()->json($response, $code);
    }
}