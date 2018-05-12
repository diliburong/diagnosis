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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
// name 为路由名可以在视图上使用route('user');
Route::get('/users', 'View\UserController@toUserList')->name('users');
Route::get('/user_add','View\UserController@toUserAdd');
Route::get('/user_edit/{userId}','View\UserController@toUserEdit');
Route::get('/my_info','View\UserController@toMyInfo');

Route::get('/patients', 'View\PatientController@toPatientList')->name('patients');
Route::get('/patient_add','View\PatientController@toPatientAdd');
Route::get('/patient_edit/{userId}','View\PatientController@toPatientEdit');

Route::get('/diagnoes/{patientId}','View\DiagonseController@toDiagonse');

Route::group(['prefix'=>'service'],function(){
	Route::post('user/add','Service\UserController@userAdd');
	Route::post('user/edit','Service\UserController@userEdit');
	Route::post('user/del','Service\UserController@userDel');

	Route::post('my_info/edit','Service\UserController@myInfoEdit');


	Route::post('patient/add','Service\PatientController@patientAdd');
	Route::post('patient/del','Service\PatientController@patientDel');
	// Route::post('product/del','Admin\ProductController@productDel');
	// Route::post('product/edit','Admin\ProductController@productEdit');

});
// Route::get('/test', 'TestController@index')->name('home');
