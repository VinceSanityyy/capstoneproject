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
Route::delete('/deleteRoom/{id}','RoomController@destroy');
Route::get('/getRoomsCheckbox','RoomController@getRooms');

Route::get('/getRoomsDatatable','RoomController@getRoomsDatatables');

//Subjects
Route::get('/getSubjects','SubjectController@index');
Route::post('/addSubject','SubjectController@store');
Route::put('/updateSubject/{id}','SubjectController@update');
Route::delete('/deleteSubject/{id}','SubjectController@destroy');


//Teachers
Route::get('/getTeachers','TeacherController@index');
Route::post('/addTeacher','TeacherController@store');
Route::put('/editTeacher/{id}','TeacherController@update');
Route::delete('/deleteTeacher/{id}','TeacherController@destroy');
Route::get('/getTeacherPersonal','TeacherController@getTeacherPersonal');

//Subject Codes
Route::get('/getSubjectCodes','SubjectCodeController@index');
Route::get('/getSubjectCodesCheckbox','SubjectCodeController@getSubjectCodes');
Route::post('/addSubjectCode','SubjectCodeController@store');
Route::put('/updateSubjectCode/{id}','SubjectCodeController@update');
Route::delete('/deleteSubjectCode/{id}','SubjectCodeController@destroy');

Route::get('/getSubjectCodesDatatable','SubjectCodeController@getSubjectCodesDatatables');

//Schedules
Route::get('/getSchedules','ScheduleController@index');
Route::post('/addSchedules','ScheduleController@store');
Route::put('/updateSchedule/{id}','ScheduleController@update');
Route::delete('/deleteSchedule/{id}','ScheduleController@destroy');

Route::get('/getSchedulesPaginate','ScheduleController@schedulePagination');

Route::get('/getDetails/{id}','CheckerController@getScheduleRound');
Route::get('/getDetailsTwo/{id}','CheckerController@getScheduleRoundTwo');

//Filter
Route::get('filterSchedule','ScheduleController@filterSchedule');

// GetViolations
Route::get('getViolations','ViolationController@index');
// getRemarks
Route::get('getRemarks','RemarksController@index');

//Rounds
Route::get('/getRound','RoundController@index');

// Graph
Route::get('/getGraph/{id}','HomeController@getGraph');

//setOverall
Route::put('/setOverall/{cid}','CheckerController@setOverall');

Route::get('/getCheckers','CheckerController@getCheckers');

//generateReport
Route::get('/generate','HomeController@generateReport');
Route::get('/generatePersonal','TeacherController@getTeacherPersonal');
Route::get('/preview','HomeController@previewReport');


//Count
Route::get('/countTeachers','TeacherController@countTeachers');
Route::get('/countSubjects','SubjectCodeController@countSubjects');
Route::get('/countCheckers','CheckerController@countCheckers');

//Imports
Route::post('/importRoom','RoomController@import');
Route::post('/importSubject','SubjectCodeController@import');
Route::post('/importTeacher','TeacherController@import');

//comments
Route::post('/addComment','CommentsController@store');
Route::get('/getComments','CommentsController@index');

//getStudents
Route::get('/getStudents','HomeController@getStudents');
Route::get('/getStudentCount','HomeController@getStudentCount');
Route::put('/updateChecker/{id}','HomeController@updateChecker');


// getViolationsGraph
Route::get('/violationsGraph/{id}','HomeController@getViolationsGraph');

// filterPending
Route::get('/filterPending','CheckerController@filterCheckers');

Route::get('{path}','HomeController@index')->where( 'path', '([A-z]+)?' );
