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

Route::get('/', function () {
    return view('welcome');
});
//登录成功之后才可以访问的路由
Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=>"admin.login"],function(){
	Route::get("index","IndexController@index");
	Route::get("info","IndexController@info");
	Route::get("logout","IndexController@logout");
    Route::match(['get','post'],"pass","IndexController@pass");
    Route::get("intest","LoginController@intest");
    Route::resource('category','CategoryController');
    Route::resource('article','ArticleController');
    Route::resource('links','LinksController');
    Route::post('category/changeOrder','CategoryController@changerOrder');
    Route::post('links/changeOrder','LinksController@changerOrder');
    Route::any('upload','CommController@upload');
});


//未登录时就可以直接访问的路由
Route::group(['prefix'=>'admin','namespace'=>'admin'],function(){
	Route::get("code","LoginController@code");
	Route::match(['get','post'],"login","LoginController@login");
	Route::get("test","LoginController@test");

});
