<?php

use App\Http\Controllers\CategoryController;
use App\Models\User;
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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/category/all',[CategoryController::class,'index'])->name('all_category');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('edit');
    Route::get('/category/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
    Route::get('/category/softDelete/{id}',[CategoryController::class,'softDelete'])->name('category.softDelete');
    Route::get('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
    Route::post('store',[CategoryController::class,'store'])->name('store.category');
    Route::post('update/{id}',[CategoryController::class,'update'])->name('update.category');
    //upper category
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});
