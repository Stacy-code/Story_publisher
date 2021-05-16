<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\PostController;


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

/**
 * Роути фронтенда
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * Роути адмінки
 */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('post', PostController::class);
});
