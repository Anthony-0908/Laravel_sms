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

Route::middleware(['role:admin'])->prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('students.index');
    Route::get('/data', [StudentController::class, 'getStudents'])->name('students.data');
    Route::get('/create', [StudentController::class, 'create'])->name('students.create');
    Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::post('/', [StudentController::class, 'store'])->name('students.store');
    Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::put('/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::get('/{id}', [StudentController::class, 'show'])->name('students.show');
});

// Route::middleware(['role:admin'])->group(function () {
//     Route::get('/students', [StudentController::class,'index'])->name('students.index');
// });
Route::middleware('role:teacher')->group(function(){
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
