<?php

use App\Http\Controllers\LaporBarangController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LaporBarangController::class, 'index'])->name('dashboard_index');
// route search
Route::get('/search', [SearchController::class, 'search'])->name('search_action');
// rotue add new data
Route::get('/from-report', function () {
    return view('action.tambah');
})->name('form_data');
Route::post('form-tambah-post', [LaporBarangController::class, 'store'])->name('form_data_add');
// route edit data
Route::get('/from-edit/{id}', [LaporBarangController::class, 'edit'])->name('form_edit');
Route::post('/from-edit-add/{id}', [LaporBarangController::class,'update'])->name('update_data');
// route delete data
Route::get('barang/{id}', [LaporBarangController::class, 'delete'])->name('delete_data');
