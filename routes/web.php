<?php

use App\Http\Controllers\SourController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/sours', [SourController::class, 'store'])->name('sours.store');
Route::patch('sours/{sour}', [SourController::class, 'update'])->name('sours.update');
Route::delete('/sours/{sour}', [SourController::class, 'destroy'])->name('sours.delete');

require __DIR__.'/auth.php';
