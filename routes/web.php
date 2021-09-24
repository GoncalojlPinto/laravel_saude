<?php

use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SpecialtyController;
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


Route::get('medicos/download', [MedicoController::class, 'download']);
Route::resource('medicos', MedicoController::class);


Route::resource('specialties', SpecialtyController::class);
Route::resource('services', ServiceController::class);

require __DIR__.'/auth.php';
