<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\Brand;
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
    //Start of Category
    Route::get('/category/all',[CategoryController::class,'index'])->name('all_category');
    Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('edit');
    Route::get('/category/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
    Route::get('/category/softDelete/{id}',[CategoryController::class,'softDelete'])->name('category.softDelete');
    Route::get('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
    Route::post('store',[CategoryController::class,'store'])->name('store.category');
    Route::post('update/{id}',[CategoryController::class,'update'])->name('update.category');
    //End of category

    //Brand

    Route::get('/brand',[BrandController::class,'index'])->name('brand');
    Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('edit.brand');
    Route::post('/store/brand',[BrandController::class,'store'])->name('store.brand');
    Route::post('update/{id}',[BrandController::class,'update'])->name('update.brand');
    Route::get('/brand/delete/{id}',[BrandController::class,'delete'])->name('delete.brand');
    //multi pic section
    Route::get('/multi',[BrandController::class,'Multipic'])->name('multi.image');
    Route::post('/store/images',[BrandController::class,'store_images'])->name('store.images');


    //end of Brand

    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});
