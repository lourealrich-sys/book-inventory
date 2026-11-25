<?php

use App\Http\Controllers\bookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('books.index'));
Route::get('/dashboard', fn() => redirect()->route('books.index'))->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/books/report', [bookController::class, 'report'])->name('books.report');
    Route::get('/books/export/pdf', [bookController::class, 'exportPdf'])->name('books.export.pdf');
    Route::get('/books/export/csv', [bookController::class, 'exportCsv'])->name('books.export.csv');
    Route::resource('books', bookController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';