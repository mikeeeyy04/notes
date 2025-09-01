<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::resource('notes', NoteController::class)->middleware('auth');

    // Route::post('/notes/save', [NoteController::class, 'save']);
    // Route::patch('/notes/{id}', [NoteController::class, 'update'])->name('notes.update');
    // Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
    Route::get('/notes', [NoteController::class, 'index']);

    Route::post('/employees/save', [EmployeeController::class, 'save']);
    Route::patch('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    Route::post('/save', [DepartmentController::class, 'save']);
    Route::patch('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

    
    Route::get('/notes', [App\Http\Controllers\NoteController::class, 'index'])->name('notes');
    Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees');
    Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments');

});

Route::get('/clear-sessions', function () {
    Artisan::call('sessions:clear-stale');
    return 'Stale sessions cleared!';
});


require __DIR__.'/auth.php';
