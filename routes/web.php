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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth','teacher']],function (){
    Route::resource('/courses', 'CourseController');
});

Route::group(['middleware'=>['auth','student']],function (){
    Route::get('/allCourses','EnrollController@index')->name('enroll.index');
    Route::post('/allCourses/{course}','EnrollController@enroll')->name('enroll.enroll');
    Route::get('/myCourses','EnrollController@myCourses')->name('enroll.myCourses');
    Route::delete('/myCourses/{course}','EnrollController@dropout')->name('enroll.dropout');
    Route::get('/myCourses/{course}','EnrollController@show')->name('enroll.show');
    Route::PUT('/myCourses/addFeedBack/{course}','EnrollController@storeFeedBack')->name('enroll.feedback');
    Route::delete('/myCourses/{course}/delete','EnrollController@deleteFeedBack')->name('enroll.deleteFeedBack');

});



Route::get('/profile/{user}/edit','UserController@index')->name('profile');
Route::PUT('/profile/{user}','UserController@update')->name('profile.update');
Route::get('/AboutUs','OthersController@aboutUs')->name('aboutUs');
Route::get('/ContactUs','OthersController@contactUs')->name('contactUs');
Route::post('/ContactUs','OthersController@sendQuestionMail')->name('contactMail');


Route::get('/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/callback', 'SocialAuthGoogleController@callback');
