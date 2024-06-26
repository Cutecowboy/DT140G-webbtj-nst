<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('product', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('book', BookController::class);
Route::resource('photo', PhotoController::class);
Route::resource('role', RoleController::class);

Route::post('add-category', [ProductController::class, 'addCategory']);
Route::get('/search/product/{name}', [ProductController::class, 'searchProduct']);
Route::get('/search/book/{id}', [BookController::class, 'searchBooking']);

// routes for register, login and logout, register and login are publically accessable
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/roleid/{id}', [AuthController::class, 'getRole']);
Route::post('/upload', [PhotoController::class, 'upload']);
Route::get('/showPhoto/{filename}', [PhotoController::class, 'showPhoto']);
Route::resource('/users', UserController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
