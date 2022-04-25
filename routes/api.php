<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

// foods
Route::get('/foods', [FoodController::class, 'index']);
Route::get('/foods/search',[FoodController::class, 'search']);
Route::get('/foods/sort',[FoodController::class, 'sort']);
Route::get('/foods/csv',[FoodController::class, 'csvDownload']);
Route::post('/foods',[FoodController::class, 'store']);
Route::get('/foods/get_major_category', [FoodController::class, 'getMajorCategory']);
Route::get('/foods/get_middle_category', [FoodController::class, 'getMiddleCategory']);
Route::get('/foods/{food}', [FoodController::class, 'show']);
Route::put('/foods/{food}', [FoodController::class, 'update']);
Route::delete('/foods/{food}', [FoodController::class, 'destroy']);