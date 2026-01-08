<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});
    Route::get('/', [CategoryController::class, 'index'])->name('home.index');
    Route::get('/Category/create', [CategoryController::class, 'create'])->name('Category.create');
    Route::post('/Category', [CategoryController::class, 'store'])->name('Category.store');
    Route::delete('/Category/{id}', [CategoryController::class, 'destroy'])->name('Category.destroy');
