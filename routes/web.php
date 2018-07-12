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

Route::get('/login','login_controller@index');
Route::get('/logout','login_controller@logout');
Route::post('/login/validate_login','login_controller@validate_login');
Route::get('/dashboard/main_dashboard','dashboard_controller@index');
Route::get('/dashboard/filter','dashboard_controller@filter_students');
Route::get('/get/students','dashboard_controller@filter_student_id');
Route::get('/add/students','student_controller@add_new_student');
Route::post('/save/student','student_controller@save_student');
Route::get('/edit/student/{st_id}','student_controller@edit_student');
Route::post('/update/student','student_controller@update_student');
Route::get('/delete/student/{st_id}','student_controller@delete_students');
