<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //permission routes
    Route::get('/permission',[PermissionController::class,'index'])->name('permission.index');
    Route::get('/permission/create',[PermissionController::class,'create'])->name('permission.create');
    Route::post('/permission',[PermissionController::class,'store'])->name('permission.store');
    Route::get('/permission/{id}/edit',[PermissionController::class,'edit'])->name('permission.edit');
    Route::post('/permission/{id}',[PermissionController::class,'update'])->name('permission.update');
    Route::delete('/permission/{id}',[PermissionController::class,'destroy'])->name('permission.destroy');

    //roles routes
    Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
    Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
    Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
    Route::get('/roles/{id}/edit',[RoleController::class,'edit'])->name('roles.edit');
    Route::post('/roles/{id}',action: [RoleController::class,'update'])->name('roles.update');
    Route::delete('/roles/{id}',action: [RoleController::class,'destroy'])->name('roles.destroy');


});

require __DIR__.'/auth.php';
