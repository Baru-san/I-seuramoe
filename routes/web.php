<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('landing');
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('template.blank');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/upload', [UploadController::class, 'index'])->name('upload')->middleware('admin');
    Route::post('/upload', [UploadController::class, 'import'])->name('import')->middleware('admin');

    Route::get('/map', [MapController::class, 'index'])->name('map');
    Route::get('/map-detail/{slug}', [MapController::class, 'detail'])->name('detail');

    ##admin


});

Route::middleware('admin')->group(function () {

Route::get('/admin/ubah-data', [AdminController::class, 'sosialData'])->name('sosialData.data');
Route::post('/edit-sosial', [AdminController::class, 'update_sosial'])->name('sosialData.edit');
Route::post('/edit-tanah', [AdminController::class, 'update_tanah'])->name('tanahData.edit');
Route::post('/edit-buah', [AdminController::class, 'update_buah'])->name('tanahData.edit');

Route::get('/ubah-data', [AdminController::class, 'sosialData'])->name('sosialData.data');
Route::get('/ubah-data', [AdminController::class, 'userData'])->name('userData.data');

Route::get('/list-user', [AdminController::class, 'listUsers']);

Route::get('/delete-data', [AdminController::class, 'deleteUser'])->name('Data.delete');

});


Route::get('/admin', function(){
    return view('admin.admin');
})->middleware('admin');


Route::get('/manage-data', [AdminController::class, 'index'])->middleware('admin');
// Route::get('/fetchdata', 'App\Http\Controllers\MapController@data');


Route::get('/edit-data', [AdminController::class, 'edit'])->name('Data.edit')->middleware('admin');

require __DIR__.'/auth.php';
