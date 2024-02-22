<?php

use App\Http\Controllers\CompanyInfoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactOptionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/company-info', [CompanyInfoController::class, 'index']);
Route::post('/company-info', [CompanyInfoController::class, 'store']);
Route::get('/company-info/{id}', [CompanyInfoController::class, 'show']);


Route::post('/contact', [ContactController::class, 'store']);
Route::get('/contact_option', [ContactOptionsController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);