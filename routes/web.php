<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\ClassesController;
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
    Route::get('delete/class/{id}', [ClassesController::class, 'DeleteClass'])->name('edit.class');
});

Route::controller(SubjectController::class)->group(function () {
    Route::get('create/subject', [SubjectController::class, 'CreateClass'])->name('create.subject');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
