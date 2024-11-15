<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\SuppliersController;
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

Route::controller(CategoriesController::class)
    ->as('api.categories.')
    ->prefix('api/categories')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });

Route::controller(SuppliersController::class)
    ->as('api.suppliers.')
    ->prefix('api/suppliers')
    ->group(function () {
        Route::get('/', 'index')->name('index');    
        Route::post('/store', 'store')->name('store');
    });

Route::controller(ItemsController::class)
    ->as('api.items.')
    ->prefix('api/items')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });
