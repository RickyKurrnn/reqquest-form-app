<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestFormController;

Route::get('/', function () {
    return view('welcome');
});

// form create & store
Route::get('/form/create', [RequestFormController::class, 'create'])->name('form.create');
Route::post('/form/store', [RequestFormController::class, 'store'])->name('form.store');

// API for requests (JSON)
Route::get('/api/requests', [RequestFormController::class, 'index'])->name('api.requests');

// request table page (blade loads the Vue component)
Route::get('/request-table', function () {
    return view('request_table');
})->name('request.table');
