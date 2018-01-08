<?php

use Illuminate\Http\Request;
use App\User;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::get('/user/{user}', function (Request $request,$user) {
//    $users = User::where('id' , $user)
//                    ->orWhere('username' ,'like', "%".$user."%")
//                    ->orWhere('email' ,'like', "%".$user."%")->get();
//    return response()->json(['users' => $users],200);
//});