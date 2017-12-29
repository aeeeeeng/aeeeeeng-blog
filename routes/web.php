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
    return response()->view("404", ["data" => "404"], 404);
});

Route::prefix("admin03061993")->group(function(){
  Route::get("/", "Auth\AdminLoginController@showLoginForm")->name("admin.login");
  Route::post("/", "Auth\AdminLoginController@login")->name("admin.login.submit");
  Route::post("/logout", 'Auth\AdminLoginController@logout')->name('admin.logout.submit');
  Route::get("/dashboard", 'AdminController@index')->name('admin.dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');