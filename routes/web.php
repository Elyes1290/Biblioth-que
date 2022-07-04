<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\HomeController;
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


//File

Route::get('upload-file', [FileUpload::class, 'createForm'])->name('file');
Route::post('upload-file', [FileUpload::class, 'fileUpload'])->name('file.store');

// Image

// Route::get('image-upload-preview', [ImageUploadController::class, 'index']);
// Route::post('upload-image', [ImageUploadController::class, 'store']);

Route::get('posts', [HomeController::class, 'index'])->name('posts');
Route::post('posts', [HomeController::class, 'store'])->name('posts.store');




Route::controller(ImageUploadController::class)->group(function(){
    Route::get('image-upload', 'index');
    Route::post('image-upload', 'store')->name('image.store');
});