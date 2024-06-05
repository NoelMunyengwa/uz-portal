<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TimetableController;
use App\Models\Course;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])
  ->middleware('auth:sanctum');
Route::get('users',[UserAuthController::class,'users'])
    ->middleware('auth:sanctum');

//COURSES API
Route::get('courses',[CourseController::class,'index']);
Route::get('courses/{department}',[CourseController::class,'getCoursesByDepartment']);
Route::post('courses',[CourseController::class,'store'])
    ->middleware('auth:sanctum');
Route::put('courses/{id}',[CourseController::class,'update'])
    ->middleware('auth:sanctum');
Route::delete('courses/{id}',[CourseController::class,'destroy'])
    ->middleware('auth:sanctum');
Route::get('courses/search/{course_code}',[CourseController::class,'search'])    
    ->middleware('auth:sanctum');
Route::get('departments',[DepartmentController::class,'index'])  
    ->middleware('auth:sanctum');
Route::get('timetables',[TimetableController::class,'index'])
    ->middleware('auth:sanctum');
Route::get('timetables/{department}',[TimetableController::class,'getTimetablesByDepartment'])
    ->middleware('auth:sanctum');
Route::post('timetables',[TimetableController::class,'store'])
    ->middleware('auth:sanctum');
//generate timetable
Route::post('timetables/generate',[TimetableController::class,'generateTimetable'])
    ->middleware('auth:sanctum');
