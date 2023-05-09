<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





// Route::redirect('/', 'register')->name('register')->middleware('guest','admin_auth');
//     Route::get('register',function() {
//         return view('auth.register');
//     })->name('register');
// Route::get('login',function() {
//     return view('auth.login');
// })->name('login');
// Route::get('/login',function() {
//     return view('auth.login');
// })->name('login');

Route::middleware(['guest'])->group(function(){
    Route::redirect('/','register');
    Route::get('register',function() {
        return view('auth.register');
    })->name('register');
    Route::get('login',function() {
        return view('auth.login');
    })->name('login');
});


Route::get('/dashboard', [ProfileController::class,'index'])->middleware(['admin_auth' , 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin_auth'])->group(function () {

    // Profile detail
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile#edit');
    Route::post('profile',[ProfileController::class, 'update'])->name('profile#update');

    // Password Change
    Route::get('changePassword',[ProfileController::class, 'directChangePass'])->name('password#page');
    Route::post('changePassword',[ProfileController::class, 'changePassword'])->name('password#change');

    // admin and student list
    Route::get('list',[UserController::class,'list'])->name('list');
    Route::get('list/{role}',[UserController::class, 'show'])->name('show');
    Route::post('delete/{id}',[UserController::class,'delete'])->name('delete');
    Route::post('update/{id}',[UserController::class,'update'])->name('update');


    //courses
    Route::get('courses',[CourseController::class,'index'])->name('course');
    Route::get('createCourse',[CourseController::class,'createPage'])->name('course#createPage');
    Route::post('createCourse',[CourseController::class,'createCourse'])->name('course#create');
    Route::post('deletePost/{id}',[CourseController::class,'deleteCourse'])->name('course#delete');
    Route::get('course/{course:slug}',[CourseController::class,'show'])->name('course#show');
    Route::get('editPost/{course:slug}',[CourseController::class,'editCourse'])->name('course#edit');
    Route::post('editPost/{id}', [CourseController::class, 'updateCourse'])->name('course#update');

    //category
    Route::get('/categories',[CategoryController::class,'index'])->name('category');
    Route::post('/categories',[CategoryController::class,'createCategory'])->name('category#create');
    Route::post('/category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('category#delete');
    Route::get('/category/{category:slug}',[CategoryController::class,'editCategory'])->name('category#edit');
    Route::post('/category/{id}',[CategoryController::class,'updateCategory'])->name('category#update');

    // enrollment
    Route::get('/enrollments',[EnrollmentController::class,'index'])->name('enrollments');
    Route::get('/enrollments/{status}',[EnrollmentController::class, 'show'])->name('enrollment');
    Route::post('/accept/{id}',[EnrollmentController::class,'accept'])->name('accept');
    Route::post('/reject/{id}',[EnrollmentController::class,'reject'])->name('reject');

    // Comments
    Route::get('/comments',[CommentController::class,'index'])->name('comments');
    Route::get('/comment/{courseId}',[CommentController::class,'show'])->name('comment');
    Route::post('/deleteComment/{id}',[CommentController::class,'delete'])->name('comment#delete');


});

require __DIR__.'/auth.php';
