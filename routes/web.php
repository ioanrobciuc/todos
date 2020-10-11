<?php

use Illuminate\Support\Facades\Route;

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

/* IOAN ROBCIUC
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
	return redirect('tasks');
});

Route::prefix('tasks')->group(function () {
	Route::get('', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
	Route::post('/store', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
});
