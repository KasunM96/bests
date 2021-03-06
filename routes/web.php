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
Route::get('/user-view','UserController@view');
// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users',"UserController");
Route::post('/user-update',"UserController@update");

Route::resource('messages','MessageController');
Route::get('/showfiles','FileController@showfiles');
Route::post('/showfiles','FileController@showfiles');

Route::get('/message-inbox','MessageController@inbox');
Route::get('/userindex','MessageController@userindex');

Route::get('/reports','ReportController@getreport');
Route::get('/viewr','ReportController@viewr');
Route::post('/reports','ReportController@getreport');


Route::get('/demo',function(){
    return view('demo');
});


Route::get('/email','MailController@index');

Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');

Route::post('sendbasicemail','MailController@basic_email');
Route::post('sendhtmlemail','MailController@html_email');
Route::post('sendattachmentemail','MailController@attachment_email');
