<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/admin', function () {
//     return view('admin.users');
// })->middleware(['auth', 'verified', 'admin'])->name('admin');

Route::middleware(['admin', 'auth'])->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'get'])->name('admin');

    Route::get('/admin/users/create', [\App\Http\Controllers\AdminController::class, 'showcreate'])->name('admin.users.creation');
    Route::post('/admin/users/create', [\App\Http\Controllers\AdminController::class, 'create'])->name('admin.users.create');

    Route::delete('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'delete'])->name('admin.users.delete');
    Route::get('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'update'])->name('admin.users.update');
    Route::patch('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'edit'])->name('admin.users.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'store'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
