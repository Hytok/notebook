<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', [MainController::class,'index'])->name('index');

Route::resource('/modal', ContactController::class);

Route::resource('/country', CountryController::class);
Route::get('count/{id?}', [CountryController::class,'destroy_country'])->name('destroy_country');

Route::resource('/city', CityController::class);

Route::get('cont/{id?}', [ContactController::class,'destr'])->name('destr');

Route::get('cities/{id?}', [CityController::class,'destroy_city'])->name('dest_city');









