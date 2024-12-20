<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController as auth;
use App\Http\Controllers\UserController as user;
use App\Http\Controllers\RoleController as role;
use App\Http\Controllers\DashboardController as dashboard;
use App\Http\Controllers\PermissionController as permission;
use App\Http\Controllers\ClassListController as classlist;
use App\Http\Controllers\SubjectController as subject;
use App\Http\Controllers\ExamTypeController as examtype;
use App\Http\Controllers\ExamController as exam;

Route::get('/register', [auth::class, 'signUpForm'])->name('register');
Route::post('/register', [auth::class, 'signUpStore'])->name('register.store');
Route::get('/', [auth::class, 'signInForm'])->name('login');
Route::post('/login', [auth::class, 'signInCheck'])->name('login.check');
Route::get('/logout', [auth::class, 'signOut'])->name('logOut');
Route::get('/forgot-password', [auth::class, 'forgotPassword'])->name('forgotPassword');
Route::post('forget-password', [auth::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [auth::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [auth::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::middleware(['checkauth'])->prefix('admin')->group(function () {
    Route::get('dashboard', [dashboard::class, 'index'])->name('dashboard');
    Route::get('userProfile', [auth::class, 'show'])->name('userProfile');
});
Route::middleware(['checkauth'])->prefix('student')->group(function () {
    Route::get('dashboard', [dashboard::class, 'index'])->name('student_dashboard');
    Route::get('userProfile', [auth::class, 'show'])->name('userProfile');
    Route::get('profile', [user::class, 'student_profile'])->name('profile');
    Route::get('profile-edit/{id}', [user::class, 'student_edit'])->name('profile_edit');
    Route::post('profile-edit/{id}', [user::class, 'student_update'])->name('profile_update');
    Route::get('exam-list',[exam::class, 'examlist'])->name('student.exam');
    Route::get('test/{id}',[exam::class, 'test'])->name('student.test');
    Route::post('test',[exam::class, 'student_submit'])->name('student_submit');
    Route::get('result/{id}',[exam::class, 'student_result'])->name('student.result');
    
});

Route::middleware(['checkrole'])->prefix('admin')->group(function(){
    Route::resource('user', user::class);
    Route::get('profile', [user::class, 'profile'])->name('user.profile');
    Route::get('student-list', [user::class, 'student'])->name('student');

    Route::resource('role', role::class);
    Route::get('permission/{role}', [permission::class,'index'])->name('permission.list');
    Route::post('permission/{role}', [permission::class,'save'])->name('permission.save');
    Route::resource('classlist', classlist::class);
    Route::resource('subject', subject::class);
    Route::resource('examtype', examtype::class);
    Route::resource('exam', exam::class);
    Route::get('exam-upload',[exam::class, 'uploadExam'])->name('exam_upload');
    Route::post('exam-upload',[exam::class, 'exam_store'])->name('exam_upload_store');
    Route::get('admin-result/{id}',[exam::class,'result_list'])->name('admin.result');
    Route::get('individual-result/{id}',[exam::class, 'individual_result'])->name('individual.result');
});
// Route::get('/', function () {
//     return view('welcome');
// });