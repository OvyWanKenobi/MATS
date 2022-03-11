<?php

use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PublicController;
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

Route::get('/',[PublicController::class,'login'])->name('Login');
Route::post('/login',[PublicController::class,'loginsubmit'])->name('Loginsubmit');
Route::get('/logout',[PublicController::class,'logout'])->name('Logout');

Route::get('OurInstructors',[PublicController::class,'InstructorList'])->name('public.instructorlist');
Route::get('OurInstructors/{id}',[PublicController::class,'InstructorDetails'])->name('public.instructordetails');
Route::get('ContactUs',[PublicController::class,'ContactUs'])->name('public.contactus');


Route::get('Instructor',[InstructorController::class,'Home'])->name('instructor.home');
Route::get('Instructor/createcourse',[InstructorController::class,'CreateCourse'])->name('instructor.createcourse');
Route::post('Instructor/createcoursesubmit',[InstructorController::class,'CreateCourseSubmit'])->name('instructor.createcoursesubmit');
Route::get('Instructor/createtopic/{courseid}',[InstructorController::class,'CreateTopic'])->name('instructor.createtopic');
Route::post('Instructor/createcoursetopic',[InstructorController::class,'CreateTopicSubmit'])->name('instructor.createtopicsubmit');
Route::get('Instructor/viewcourse/{id}',[InstructorController::class,'ViewCourse'])->name('instructor.viewcourse');
Route::get('Instructor/topic/{id}',[InstructorController::class,'ViewTopic'])->name('instructor.viewtopic');
Route::get('Instructor/topic/{topicid}/addquiz',[InstructorController::class,'Addquiz'])->name('instructor.addquiz');
Route::post('Instructor/topic/addquizsubmit',[InstructorController::class,'Addquizsubmit'])->name('instructor.addquizsubmit');

Route::get('Instructor/editcourse',[InstructorController::class,'EditCourse'])->name('instructor.editcourse');
Route::post('Instructor/editcoursesubmit',[InstructorController::class,'EditCourseSubmit'])->name('instructor.editcoursesubmit');


Route::get('Instructor/deletecourse',[InstructorController::class,'DeleteCourse'])->name('instructor.deletecourse');
Route::get('Instructor/deletecoursesubmit/{id}',[InstructorController::class,'DeleteCourseSubmit'])->name('instructor.deletecoursesubmit');

