<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Models\User;

// Ini kalo pake query builder
use Illuminate\Support\Facades\DB;
// ====================
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

Route::get('/home', function () {
    echo "This is home page";
});

// Route::get('/about', function () {
//     return view('about');
// })->middleware('umur');

Route::get('/about', function () {
    return view('about');
});

Route::get('/kontak', function () {
    return view('kontak');
});

// Category Controller
Route::get('/category/all',[CategoryController::class, 'AllCate'])->name('all.category');

Route::post('/category/add',[CategoryController::class, 'AddCate'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class, 'Edit']);
Route::post('/category/update/{id}',[CategoryController::class, 'Update']);

Route::get('/softdelete/category/{id}',[CategoryController::class, 'Softdelete']);
Route::get('/category/restore/{id}',[CategoryController::class, 'Restore']);
Route::get('/pdelete/category/{id}',[CategoryController::class, 'Pdelete']);


// Brand
Route::get('/brand/all',[BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class, 'StoreBrand'])->name('store.brand');


Route::get('/kontak', [KontakController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // Ini kalo pake eloquent
    // $users = User::all();
// ====================
    // Ini kalo pake query builder
    $users = DB::table('users')->get();
    // ====================
    return view('dashboard', compact('users'));
})->name('dashboard');