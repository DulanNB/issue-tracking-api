<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

//Issue api-routes
Route::apiResource('/issues','App\Http\Controllers\IssueController');

//Category api-routes
Route::apiResource('/categories','App\Http\Controllers\CategoryController');

//SubCategory api-routes
Route::apiResource('/sub-category','App\Http\Controllers\SubcategoryController');

//SubCategory api-routes
Route::apiResource('/comments','App\Http\Controllers\CommentController');
