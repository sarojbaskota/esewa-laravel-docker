<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

// Route::post('/pay', [EsewaController::class, 'pay']);
// Route::get('/success', [EsewaController::class, 'success']);
// Route::get('/failure', [EsewaController::class, 'failed']);

// with package 

Route::get('/pay', [ProductController::class, 'pay']); // get method for ignore form you can use another
Route::get('/success', [ProductController::class, 'success']);
Route::get('/fail', [ProductController::class, 'fail']);