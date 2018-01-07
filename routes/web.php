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


Route::namespace('Basic')->group(function(){
    Route::get('/','PageController@index')->name('home');
    Route::get('category/{id}','CategoryController@show')->name('category.show');
});


//register, login/out, reset password
Auth::routes();
Route::prefix('verify')->namespace('Auth')->group(function(){
    Route::get('{token}','VerifyController@verifyUser')->name('verifyMessage');
    Route::get('/','VerifyController@getVerifyForm')->name('getVerifyForm');
    Route::post('/','VerifyController@reSendVerifyEmail')->name('sendVerifyForm');
});

//backend, for admin
Route::prefix('admin')->namespace('Admin')->group(function(){
    Route::get('/','adminController@index')->name('admin.index');
    Route::get('/dashboard' , 'adminController@dashboard')->name('admin.dashboard');
    Route::resource('user','UserController');
    Route::post('user/block',"UserController@block")->name('admin.user.block');
    Route::post('user/search',"UserController@search")->name('admin.user.search');
});
