<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/{workspace}/projects', function () {
    return Inertia::render('Projects');
})->middleware(['auth', 'verified'])->name('projects');

//Route::get('/{workspace}/users', [\App\Http\Controllers\UserController::class, 'index'])->middleware('auth')->name('users');
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->middleware('auth')->name('user.edit');
Route::post('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->middleware('auth')->name('user.update');

Route::get('/{workspace}/users', [\App\Http\Controllers\WorkspaceUsersController::class, 'index'])->middleware('auth')->name('members');
Route::get('/{workspace}/users/invitations', [\App\Http\Controllers\InvitationController::class, 'create'])->middleware('auth')->name('invitations');
Route::post('/{workspace}/users/invitations', [\App\Http\Controllers\InvitationController::class, 'store'])->middleware('auth')->name('invitations.store');

require __DIR__.'/auth.php';
