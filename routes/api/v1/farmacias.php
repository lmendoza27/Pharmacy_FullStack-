<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\FarmaciaController;

Route::controller(FarmaciaController::class)->group(function () {
    Route::get('/farmacias', 'index');
    Route::post('/farmacias', 'store')->name('farmacias.store');
    Route::get('/farmacia/{id}', 'show');
    Route::put('/farmacias/{id}', 'update');
    Route::delete('/farmacias/{id}', 'destroy');
    Route::get('/farmacia', 'cercanos')->name('farmacias.nearest')->middleware('auth:api');
    Route::get('/farmacia', 'cercanos')->name('farmacia.nearest');
});


?>