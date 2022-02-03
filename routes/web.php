<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;
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

Route::get('/', [ContatoController::class, 'index'])->middleware('auth');
Route::get('/contacts/dashboard/{id}', [ContatoController::class, 'dashboard'])->middleware('auth');
Route::get('/contacts/create', [ContatoController::class, 'create'])->middleware('auth');
Route::get('/contacts/{id}', [ContatoController::class, 'show'])->middleware('auth');
Route::post('/contacts', [ContatoController::class, 'store'])->middleware('auth');
Route::delete('/contacts/{id}', [ContatoController::class, 'destroy'])->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/*

*/
