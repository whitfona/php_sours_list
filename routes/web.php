<?php

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

Route::post('/sours', [Sour::class, 'store'])->name('sours.store');
Route::delete('/sours/{sour}', [Sour::class, 'destroy'])->name('sours.delete');

Route::patch('sours/{sour}', function (Sour $sour) {

    $validated = request()->validate([
        'company' => ['sometimes', 'required', 'string', 'max:100'],
        'name' => ['sometimes', 'required', 'string', 'unique:sours,name', 'max:100'],
        'percent' => ['sometimes', 'numeric', 'gte:0'],
        'comments' => ['sometimes', 'string', 'max:280'],
        'rating' => ['sometimes', 'numeric', 'gte:0'],
        'hasLactose' => ['sometimes', 'boolean'],
        ],
        [ 'name.unique' => 'That sour has already been rated!', ]
    );

    $sour->update($validated);

})->name('sours.update');


require __DIR__.'/auth.php';
