<?php

use App\Http\Controllers\SourController;
use App\Models\Sour;
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


Route::get('/sours', function () {
    $sours = Sour::all()->sortByDesc('rating');

    return view('sours.index', compact('sours'));

})->name('sours.index');


Route::post('/sours', [SourController::class, 'store'])->middleware(['auth'])->name('sours.store');
Route::patch('sours/{sour}', [SourController::class, 'update'])->middleware(['auth'])->name('sours.update');
Route::delete('/sours/{sour}', [SourController::class, 'destroy'])->middleware(['auth'])->name('sours.delete');

require __DIR__.'/auth.php';
