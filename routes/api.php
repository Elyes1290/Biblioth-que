<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PeopleController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use L5Swagger\Exceptions\L5SwaggerException;
use L5Swagger\Generator;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Form::model($commission, array('action' => array('CommissionController@update', $commission->id), 'method' => 'PUT'));
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

     
Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);
});

Route::middleware('auth:api')->get('users', function (Request $request) {
    return $request->user();
});


// Route::resource('products', ProductController::class);

route::apiResource('authors', AuthorController::class);
route::apiResource('countries', CountryController::class);
route::apiResource('categories', CategoryController::class);
route::apiResource('people', PeopleController::class);
route::apiResource('books', BookController::class);





