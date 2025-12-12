<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestFormController;
use App\Http\Controllers\PDFController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/form/create', [RequestFormController::class, 'create']);
Route::post('/form/store', [RequestFormController::class, 'store'])->name('form.store');

Route::get('/export-pdf', [PDFController::class, 'exportPDF']);


