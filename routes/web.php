<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\ClassesController;
use App\Http\Controllers\backend\ResultController;
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\backend\SubjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(AdminController::class)->group(function () {
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('admin/profile/update', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('admin/profile/change-password', [AdminController::class, 'AdminChangePassword'])->name('admin.change-password');
    Route::post('admin/profile/change-password', [AdminController::class, 'AdminChangePasswordUpdate'])->name('admin.password.update');
});

Route::controller(ClassesController::class)->group(function () {
    Route::get('create/class', [ClassesController::class, 'CreateClass'])->name('create.class');
    Route::post('create/class', [ClassesController::class, 'StoreClass'])->name('store.class');
    Route::get('manage/class', [ClassesController::class, 'ManageClass'])->name('manage.class');
    Route::get('edit/class/{id}', [ClassesController::class, 'EditClass'])->name('edit.class');
    Route::post('update/class', [ClassesController::class, 'UpdateClass'])->name('update.class');
    Route::get('delete/class/{id}', [ClassesController::class, 'DeleteClass'])->name('delete.class');
});

Route::controller(SubjectController::class)->group(function () {
    Route::get('create/subject', [SubjectController::class, 'CreateSubject'])->name('create.subject');
    Route::post('create/subject', [SubjectController::class, 'StoreSubject'])->name('store.subject');
    Route::get('manage/subject', [SubjectController::class, 'ManageSubject'])->name('manage.subject');
    Route::get('edit/subject/{id}', [SubjectController::class, 'EditSubject'])->name('edit.subject');
    Route::post('update/subject', [SubjectController::class, 'UpdateSubject'])->name('update.subject');
    Route::get('delete/subject/{id}', [SubjectController::class, 'DeleteSubject'])->name('delete.subject');

    // Subject Combination All Routes
    Route::get('add/subject/combination', [SubjectController::class, 'AddSubjectCombination'])->name('add.subject.combination');
    Route::post('add/subject/combination', [SubjectController::class, 'StoreSubjectCombination'])->name('store.subject.combination');
    Route::get('manage/subject/combination', [SubjectController::class, 'ManageSubjectCombination'])->name('manage.subject.combination');
    Route::get('deactivate/subject/combination/{id}', [SubjectController::class, 'DeactivateSubjectCombination'])->name('deactivate.subject.combination');
});

Route::controller(StudentController::class)->group(function () {
    Route::get('add/student', [StudentController::class, 'AddStudent'])->name('add.student');
    Route::post('add/student', [StudentController::class, 'StoreStudent'])->name('store.student');
    Route::get('manage/student', [SubjectController::class, 'ManageStudent'])->name('manage.student');
    Route::get('edit/student/{id}', [StudentController::class, 'EditStudent'])->name('edit.student');
    Route::post('update/student', [StudentController::class, 'UpdateStudent'])->name('update.student');
    Route::get('delete/student/{id}', [StudentController::class, 'DeleteStudent'])->name('delete.student');
});

Route::controller(ResultController::class)->group(function () {
    Route::get('add/result', [ResultController::class, 'AddResult'])->name('add.result');
    Route::post('add/result', [ResultController::class, 'StoreResult'])->name('store.result');
    Route::get('manage/result', [ResultController::class, 'ManageResult'])->name('manage.result');
    Route::get('edit/result/{id}', [ResultController::class, 'EditResult'])->name('edit.result');
    Route::post('update/result', [ResultController::class, 'UpdateResult'])->name('update.result');
    Route::get('delete/result/{id}', [ResultController::class, 'DeleteResult'])->name('delete.result');



    // fetch the result
    Route::get('fetch/student', [ResultController::class, 'FetchStudent'])->name('fetch.student');
    Route::get('fetch/student/result', [ResultController::class, 'FetchStudentResult'])->name('check.student.result');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
