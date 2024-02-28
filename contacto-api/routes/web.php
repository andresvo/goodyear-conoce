<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SorteoController;

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

Route::get('/dashboard', [ContactController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/contactos/exportar', [ContactController::class, 'export'])->middleware(['auth'])->name('contacts.export');
Route::get('/sorteos/exportar', [SorteoController::class, 'export'])->middleware(['auth'])->name('sorteos.export');

require __DIR__.'/auth.php';
