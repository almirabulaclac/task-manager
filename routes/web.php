<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'loginForm'])->name('user.login');


Route::get('/dashboard', function () {
    return redirect()->route('projects.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     // Project routes - Laravel will automatically bind using projectID
//     Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
//     Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
//     Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
//     Route::get('/projects/{project:projectID}', [ProjectController::class, 'show'])->name('projects.show');
//     Route::get('/projects/{project:projectID}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
//     Route::put('/projects/{project:projectID}', [ProjectController::class, 'update'])->name('projects.update');
//     Route::delete('/projects/{project:projectID}', [ProjectController::class, 'destroy'])->name('projects.destroy');

//     // Task routes - Laravel will automatically bind using taskID and projectID
//     Route::post('/projects/{project:projectID}/tasks', [TaskController::class, 'store'])->name('tasks.store');
//     Route::get('/tasks/{task:taskID}', [TaskController::class, 'show'])->name('tasks.show');
//     Route::put('/tasks/{task:taskID}', [TaskController::class, 'update'])->name('tasks.update');
//     Route::patch('/tasks/{task:taskID}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
//     Route::delete('/tasks/{task:taskID}', [TaskController::class, 'destroy'])->name('tasks.destroy');
// });