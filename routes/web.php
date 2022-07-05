<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

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

Route::get('/sss', function () {
    return ["hey"];
});

Route::get('/clients',[ClientController::class, 'index']);
Route::get('/clients/{id}',[ClientController::class, 'show']);
Route::post('/clients/create',[ClientController::class, 'store']);
Route::put('/clients/{id}',[ClientController::class, 'update']);
Route::delete('/clients/{id}',[ClientController::class, 'destroy']);



Route::get('/providers',[ProviderController::class, 'index']);
Route::post('/providers/create',[ProviderController::class, 'store']);
Route::put('/providers/{id}',[ProviderController::class, 'update']);
Route::delete('/proviedrs/{id}',[ProviderController::class, 'destroy']);


Route::get('/products',[ProductController::class, 'index']);
Route::post('/products/create',[ProductController::class, 'store']);
Route::put('/products/{id}',[ProductController::class, 'update']);
Route::delete('/products/{id}',[ProductController::class, 'destroy']);


Route::get('/transactions',[TransactionController::class, 'index']);
Route::post('/transactions/create',[TransactionController::class, 'store']);
Route::put('/transactions/{id}',[TransactionController::class, 'update']);
Route::delete('/transactions/{id}',[TransactionController::class, 'destroy']);

Route::get('/dashboard',[DashboardController::class, 'index']);
