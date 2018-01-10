<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/','PageController@index')->name('home');
Route::get('category/{id}','CategoryController@show')->name('category.show');
//post manage
Route::resource('post','PostController', ['except' => ['index','destroy']]);



//register, login/out, reset password
Auth::routes();
Route::prefix('verify')->namespace('Auth')->group(function(){
    Route::get('{token}','VerifyController@verifyUser')->name('verifyMessage');
    Route::get('/','VerifyController@getVerifyForm')->name('getVerifyForm');
    Route::post('/','VerifyController@reSendVerifyEmail')->name('sendVerifyForm');
});

//backend, for admin
Route::prefix('admin')->group(function(){
    //dashboard
    Route::get('/','Admin\adminController@index')->name('admin.index');
    Route::get('/dashboard' , 'Admin\adminController@dashboard')->name('admin.dashboard');
    //user
    Route::resource('user','Admin\UserController', ['except' => 'destroy']);
    Route::post('user/block',"Admin\UserController@block")->name('admin.user.block');
    Route::post('user/search',"Admin\UserController@search")->name('admin.user.search');
    //role
    Route::resource('role','Admin\RoleController', ['except' => 'destroy']);
    Route::post('role/assign','Admin\RoleController@assignRole')->name('admin.role.assign');
    //permission
    Route::resource('permission','Admin\PermissionController' , ['only' => ['index','store']]);
    Route::put('permission/update','Admin\PermissionController@update')->name('permission.update');
    //post manage
    Route::get('post','PostController@index')->name('admin.post.index');
    Route::delete('post/{id}','PostController@destroy')->name('admin.post.destroy');
});
