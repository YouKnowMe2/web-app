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
    Route::post('store',[CategoryController::class,'store'])->name('store.category');
    //upper category
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});
