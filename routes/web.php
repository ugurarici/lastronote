<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DirectoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class);
    Route::resource('directories', DirectoryController::class)->except(['index', 'show', 'create', 'edit']);
});

require __DIR__.'/auth.php';
