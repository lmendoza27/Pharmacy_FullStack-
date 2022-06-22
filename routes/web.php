<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmaciaController;

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

//Auth::routes();



//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 

Route::group(['middleware' => ['prevent-back-history']],function(){

	Auth::routes();

	//Route::get('/home', 'HomeController@index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/logs', [App\Http\Controllers\HomeController::class, 'logs'])->name('logs');

    Route::get('ajax-crud-datatable', [FarmaciaController::class, 'index']);
    Route::post('store-farmacia', [FarmaciaController::class, 'store']);
    Route::post('edit-farmacia', [FarmaciaController::class, 'edit']);
    Route::post('delete-farmacia', [FarmaciaController::class, 'destroy']);
});


Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');