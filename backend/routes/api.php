<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ApiCommentController;
use App\Http\Controllers\ApiSearchController;
//use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [ApiController::class, 'getUsers']);
Route::get('/users/{id}', [ApiController::class, 'getUser']);
Route::get('/currentuser', [ApiController::class, 'getCurrentUser']);

Route::post("/register", [ApiController::class, 'register']);
Route::post('/signin', [ApiController::class, 'signin']);

Route::post('/setuser/{id}', [ApiController::class, 'setUser']);
Route::post('/deluser/{id}', [ApiController::class, 'delUser']);

Route::post('/setusername/{id}', [ApiController::class, 'setUserName']);
Route::post('/setuseremail/{id}', [ApiController::class, 'setUserEmail']);
Route::post('/setuserlocation/{id}', [ApiController::class, 'setUserLocation']);
Route::post('/setusergender/{id}', [ApiController::class, 'setUserGender']);
Route::post('/setuserbirthdate{id}', [ApiController::class, 'setUserBirthdate']);
Route::post('/setuserpicture{id}', [ApiController::class, 'setUserPicture']);

Route::get('/posts', [ApiPostController::class, 'getPosts']);
Route::get('/posts/{id}', [ApiPostController::class, 'getPost']);
Route::post('/createpost',[ApiPostController::class, 'createPost']);
Route::post('/setpost/{id}',[ApiPostController::class, 'setPost']);
Route::post('/deletepost/{id}',[ApiPostController::class, 'deletePost']);

Route::get('/comments', [ApiCommentController::class, 'getComments']);
Route::get('/comments/{id}', [ApiCommentController::class, 'getComment']);
Route::post('/addcomment', [ApiCommentController::class, 'addComment']);
Route::post('/setcomment/{id}', [ApiCommentController::class, 'setComment']);
Route::post('/delcomment/{id}', [ApiCommentController::class, 'delComment']);
Route::get('/commentsofpost/{id}', [ApiCommentController::class, 'commentsOfPost']);

Route::get('/search/{params}', [ApiSearchController::class, 'search']);