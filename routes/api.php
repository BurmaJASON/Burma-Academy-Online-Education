<?php

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EnrollmentController;
use App\Http\Controllers\Api\MailToAdminsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//user register
Route::post('register',[AuthController::class,'register'])->name('user#register');
//user login
Route::post('login',[AuthController::class,'login'])->name('user#login');


//all count for about view
Route::get('countings',[AuthController::class,'count'])->name('count');


//courses
Route::get('courses',[CourseController::class,'index'])->name('courses#index');
Route::post('coursesUpdate',[CourseController::class, 'viewCount'])->name('course#viewCount');


// enrollment
Route::get('enrollments',[EnrollmentController::class,'index'])->name('enrollment#index');
Route::get('enrollments/{userId}',[EnrollmentController::class,'userEnrolls'])->name('enrollment#userEnrolls');

Route::post('enroll',[EnrollmentController::class,'store'])->name('enrollment#store');
Route::post('cancelEnroll',[EnrollmentController::class,'delete'])->name('enrollment#delete');

// comment
Route::post('comment',[CommentController::class,'store'])->name('comment#store');

// Mail to Admins
Route::post('mail',[MailToAdminsController::class,'send'])->name('mail#send');
