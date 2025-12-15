<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestFormController;

Route::get('/', function () {
    return view('welcome');
});

// List (index)
Route::get('/form', [RequestFormController::class, 'index'])->name('form.index');
Route::get('/form/create', [RequestFormController::class, 'create'])->name('form.create');
Route::post('/form/store', [RequestFormController::class, 'store'])->name('form.store');

Route::get('/form/export-csv', [RequestFormController::class, 'exportCsv'])->name('form.export.csv');
Route::get('/form/{id}/print', [RequestFormController::class, 'print'])->name('form.print');
Route::get('/form/{id}/export-pdf', [RequestFormController::class, 'exportPdf'])->name('form.export.pdf');
Route::get('/request-table', [RequestFormController::class, 'index']);

Route::get('/form/{id}/export-form', [RequestFormController::class, 'exportFormPDF'])->name('form.export.new');
