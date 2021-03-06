<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function(){
    return view('about');
});

Route::get('/contact/leaders', [ContactController::class, 'index'])->name('lead');

Route::get('/category/all', [CategoryController::class, 'index'])->name('all.category');

Route::post('/category/add', [CategoryController::class, 'addCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);

Route::post('/category/update/{id}', [CategoryController::class, 'update']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'softDelete']);

Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);

Route::get('/pdelete/category/{id}', [CategoryController::class, 'permanentDeleteCat']);

//For Brand route

Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');

Route::post('/brand/add', [BrandController::class, 'store'])->name('store.brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);

Route::post('/brand/update/{id}', [BrandController::class, 'update']);

Route::get('brand/delete/{id}', [BrandController::class, 'delete']);

//Multi Images
Route::get('/multi/image', [BrandController::class, 'multiPic'])->name('multi.image');

Route::post('/multi/add', [BrandController::class, 'storeMulti'])->name('store.image');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all();
   // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class,'logout' ])->name('user.logout');
