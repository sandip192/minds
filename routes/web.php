<?php

use App\Http\Controllers\FileHandleController;
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

Route::get('/', function () {
	return view('welcome');
});

Route::get('/file', [FileHandleController::class, 'index'])->name('file.handle.form');
Route::get('/list-file', [FileHandleController::class, 'list'])->name('file.handle.list');
Route::post('/create-file', [FileHandleController::class, 'store'])->name('file.handle.store');
Route::post('/create-edit', [FileHandleController::class,'edit'])->name('file.handle.edit');

Route::post('/update-file', [FileHandleController::class, 'update'])->name('file.handle.update');
Route::delete('/update-delete', [FileHandleController::class, 'remove'])->name('file.handle.delete');

