<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', [CarController::class, 'show'])->name('cars.show');
Route::get('/edit/{id}', [CarController::class, 'edit'])->name('cars.edit');
Route::post('/update/{id}', [CarController::class, 'update'])->name('cars.update');
Route::delete('/delete/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
Route::post('/create', [CarController::class, 'create'])->name('cars.create');


Route::get('/cars/export-pdf', [CarController::class, 'exportPDF'])->name('cars.export.pdf');
Route::get('/cars/export-excel', [CarController::class, 'exportExcel'])->name('cars.export.excel');
