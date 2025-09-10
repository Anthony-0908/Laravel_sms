<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/student',[StudentController::class,'index']);

Route::middleware('role:admin')->group(function() {
    Route::get('/student',[StudentController::class,'index'])->name('students.index');
    Route::get('/students',[StudentController::class,'getStudents'])->name('students.data');
    Route::get('/students-create',[StudentController::class,'create'])->name('students.create');
    Route::get('/students/{id}/edit',[StudentController::class,'edit'])->name('students.edit');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
});

Route::middleware('role:teacher')->group(function(){

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
