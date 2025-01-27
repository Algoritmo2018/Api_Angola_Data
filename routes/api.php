<?php

use App\Http\Controllers\Api\ComuneController;
use App\Http\Controllers\Api\MunicipalityController;
use App\Http\Controllers\Api\ProvinceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

//Routes Province
Route::post('/province', [ProvinceController::class, 'store'])->name('province.store');
Route::get('/province', [ProvinceController::class, 'index'])->name('province.index');
Route::put('/province/{id}', [ProvinceController::class, 'update'])->name('province.update');
// Route::get('/province/restore_one/{id}', [ProvinceController::class, 'restore_one'])->name('province.restore_one');
// Route::get('/province/restore_all', [ProvinceController::class, 'restore_all'])->name('province.restore_all');
// Route::get('/province/deleted_at', [ProvinceController::class, 'show_deleted'])->name('province.show_deleted');
// Route::get('/province/all/schools', [ProvinceController::class, 'index2'])->name('province.index2');
// Route::delete('/province/{id}', [ProvinceController::class, 'destroy'])->name('province.destroy');


//Routes Municipality
Route::post('/municipality', [MunicipalityController::class, 'store'])->name('municipality.store');
Route::get('/municipality', [MunicipalityController::class, 'index'])->name('municipality.index');
Route::put('/municipality/{id}', [MunicipalityController::class, 'update'])->name('municipality.update');

//Routes Comune
Route::post('/comune', [ComuneController::class, 'store'])->name('comune.store');
Route::get('/comune', [ComuneController::class, 'index'])->name('comune.index');
Route::put('/comune/{id}', [ComuneController::class, 'update'])->name('comune.update');
Route::delete('/comune/{id}', [ComuneController::class, 'destroy'])->name('comune.destroy');
Route::get('/comune/show/deleted', [ComuneController::class, 'show_deleted'])->name('comune.show_deleted');
Route::get('/comune/restore_one/{id}', [ComuneController::class, 'restore_one'])->name('comune.restore_one');
Route::get('/comune/restore_all', [ComuneController::class, 'restore_all'])->name('comune.restore_all');
