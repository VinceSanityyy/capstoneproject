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

Route::get('/login', function () {

});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

// Route::resource('/teachers','TeacherController');

//ROOMS
Route::get('/getRooms','RoomController@index');
Route::post('/addRoom','RoomController@store');
Route::put('/updateRoom/{id}','RoomController@update');

//Departments
Route::get('/getDepartments','DepartmentController@index');
Route::post('/addDepartment','DepartmentController@store');
Route::put('/updateDepartment/{id}','DepartmentController@update');

//Subjects
Route::get('/getSubjects','SubjectController@index');
Route::post('/addSubject','SubjectController@store');
Route::put('/updateSubject/{id}','SubjectController@update');

//Teachers
Route::get('/getTeachers','TeacherController@index');
Route::post('/addTeacher','TeacherController@store');


Route::get('{path}','HomeController@index')->where( 'path', '([A-z]+)?' );
