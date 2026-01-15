<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestFormController;
use App\Http\Controllers\TcodeFormController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return redirect()->route('form.list');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

});

Route::middleware('auth')->group(function () {

    // List (index)
    Route::get('/form', [RequestFormController::class, 'index'])->name('form.index');
    Route::get('/form/create', [RequestFormController::class, 'create'])->name('form.create');
    Route::post('/form/store', [RequestFormController::class, 'store'])->name('form.store');

    Route::get('/form/tcode/create', [TcodeFormController::class, 'viewCreate'])->name('form.tcode.create');
    Route::post('/form/tcode/store', [TcodeFormController::class, 'store'])->name('form.tcode.store');
    Route::get('/form/tcode/data', [TcodeFormController::class, 'getData'])->name('form.tcode.data');
    Route::get('/form/tcode/search', [TcodeFormController::class, 'searchDataForm'])->name('form.tcode.search');
    Route::get('/form/tcode/list', [TcodeFormController::class, 'viewList'])->name('form.tcode.list');
    Route::get('/form/tcode/detail/{id}', [TcodeFormController::class, 'detailForm'])->name('form.tcode.detail');
    Route::put('/form/tcode/update/{id}', [TcodeFormController::class, 'updateForm'])->name('form.tcode.update');
    Route::put('/form/tcode/delete/{id}', [TcodeFormController::class, 'softDelete'])->name('form.tcode.delete');

    Route::get('/form/export-csv', [RequestFormController::class, 'exportCsv'])->name('form.export.csv');
    Route::get('/form/{id}/print', [RequestFormController::class, 'print'])->name('form.print');
    Route::get('/form/{id}/export-pdf', [RequestFormController::class, 'exportPdf'])->name('form.export.pdf');
    Route::get('/request-table', [RequestFormController::class, 'index']);

    Route::get('/form/{id}/export-form', [RequestFormController::class, 'exportFormPDF'])->name('form.export.new');
    Route::get('/form/data', [RequestFormController::class, 'getData'])->name('form.data');
    Route::get('/form/list', [RequestFormController::class, 'viewList'])->name('form.list');
    Route::get('/form/search', [RequestFormController::class, 'searchDataForm'])->name('form.search');
    Route::get('/form/detail/{id}', [RequestFormController::class, 'detailForm'])->name('form.detail');
    Route::put('/form/update/{id}', [RequestFormController::class, 'updateForm'])->name('form.update');
    Route::put('/form/delete/{id}', [RequestFormController::class, 'softDelete'])->name('form.delete');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/pdf/{id}/export-tcode', [PdfController::class, 'exportTcodePDF'])->name('pdf.export.tcode');
    Route::get('/pdf/export-cr', [PdfController::class, 'exportCrPDF'])->name('pdf.export.cr');
    Route::get('/pdf/export-transport', [PdfController::class, 'exportTransportPDF'])->name('pdf.export.transport');
    Route::get('/pdf/export-functional', [PdfController::class, 'exportFunctionalPDF'])->name('pdf.export.functional');

});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/users', [AdminUserController::class, 'showUserManagement'])->name('admin.users');
    Route::get('/admin/users/search', [AdminUserController::class, 'searchUserData'])->name('admin.users.search');
    Route::get('/admin/users/data', [AdminUserController::class, 'getUserData'])->name('admin.users.data');
    Route::post('/admin/users/{id}/approve', [AdminUserController::class, 'approve'])->name('admin.users.approve');
    Route::post('/admin/users/{id}/reject', [AdminUserController::class, 'reject'])->name('admin.users.reject');
    Route::post('/admin/users/{id}/make-admin', [AdminUserController::class, 'makeAdmin'])->name('admin.users.makeAdmin');

});


