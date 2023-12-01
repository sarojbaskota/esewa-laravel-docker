<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EsewaIntegration;
use App\Http\Controllers\ProductController;

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
// without package 
//new version 2023 v2
Route::get('/test', [EsewaIntegration::class, 'index']);
Route::get('/e-pay', [EsewaIntegration::class, 'pay']);
Route::get('/e-success', [EsewaIntegration::class, 'eSuccess']);
Route::get('/e-failure', [EsewaIntegration::class, 'eFailure']);

// with package 

Route::get('/pay', [ProductController::class, 'pay']); // get method for ignore form you can use another
Route::get('/success', [ProductController::class, 'success']);
Route::get('/fail', [ProductController::class, 'fail']);