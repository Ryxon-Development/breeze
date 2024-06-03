<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('lang/nl', [LanguageController::class, 'dutch'])->name('lang.nl');
    Route::get('lang/en', [LanguageController::class, 'english'])->name('lang.en');

    //---USERS---
    //index
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    //show
    Route::get('/users/{id}/show', [UserController::class, 'show'])->name('users.show');
    //create
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    //edit
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    //delete
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //---TASKS---
    //index
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    //show
    Route::get('/tasks/{task}/show', [TaskController::class, 'show'])->name('tasks.show');
    //create
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    //edit
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    //delete
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy'); //using {task} instead of {id} because of Route Model Binding
});

Route::middleware('auth')->group(function () {
    Route::put('/generate-token/{user}', [UserController::class, 'generateApiToken'])->name('generate-token');
    Route::delete('/revoke-token/{user}', [UserController::class, 'revokeApiToken'])->name('revoke-token');
});

Route::post('/test', [TestController::class, 'submit'])->name('test.submit');

require __DIR__.'/auth.php';
