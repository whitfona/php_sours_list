<?php

use App\Http\Controllers\SourController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->prefix('/sours')->group(function() {
    Route::post('/', [SourController::class, 'store'])->name('sours.store');
    Route::get('/', [SourController::class, 'index'])->name('sours.index');
    Route::get('/{sour}', [SourController::class, 'show'])->name('sours.show');
    Route::patch('/{sour}', [SourController::class, 'update'])->name('sours.update');
    Route::delete('/{sour}', [SourController::class, 'destroy'])->name('sours.delete');
});


require __DIR__.'/auth.php';
