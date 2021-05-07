<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/admin','AdminController@index')->name('admin')->middleware('admin');
Route::resource('services', 'ServiceController');
Route::post('/services-update', 'ServiceController@update');
Route::post('/client-update', 'ClientController@update');
Route::resource('admin', 'ServiceController');
Route::resource('clients', 'ClientController');




Route::get('/user','UserController@index')->name('user')->middleware('user');
// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users',"UserController");

Route::resource('messages','MessageController');
Route::get('/showfiles','FileController@showfiles');
Route::post('/showfiles','FileController@showfiles');

Route::get('/message-inbox','MessageController@inbox');
Route::get('/userindex','MessageController@userindex');


Route::get('/demo',function(){
    return view('demo');
});
