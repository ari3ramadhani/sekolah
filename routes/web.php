<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultipicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePass;
use App\Models\User;
use App\Models\Multipic;

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

// start email verifikasi

// end email verifikasi


Route::get('/', function () {
    // menggunakan query builder jangan lupa import controller diatas
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->latest('id')->first();

    // menggunakan eloquent jangan lupa import model diatas
    $images = Multipic::all();

    return view('home',compact('brands', 'abouts', 'images'));
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
Route::get('/brand/edit/{id}',[BrandController::class, 'Edit']);
Route::post('/brand/update/{id}',[BrandController::class, 'Update']);
Route::get('/brand/delete/{id}',[BrandController::class, 'Delete']);


// multi picture
Route::get('/multi/image',[MultipicController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add',[MultipicController::class, 'StoreImage'])->name('store.image');

// Admin Semua route
Route::get('/home/slider',[HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider',[HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider',[HomeController::class, 'StoreSlider'])->name('store.slider');



// Home about Semua route
Route::get('/home/about',[AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about',[AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about',[AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}',[AboutController::class, 'EditAbout']);
Route::post('/update/homeabout/{id}',[AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}',[AboutController::class, 'DeleteAbout']);


// Halaman route portfolio
Route::get('/portfolio',[AboutController::class, 'Portfolio'])->name('portfolio');

// Halaman Admin Contact Page route
Route::get('/admin/contact',[ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact',[ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/contact',[ContactController::class, 'AdminStoreContact'])->name('store.contact');


// Halaman Home Contact Page route
Route::get('/contact',[ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form',[ContactController::class, 'ContactForm'])->name('contact.form');
Route::get('/admin/message',[ContactController::class, 'AdminMessage'])->name('admin.message');



Route::get('/kontak', [KontakController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // Ini kalo pake eloquent
    // $users = User::all();
// ====================
    // Ini kalo pake query builder
    $users = DB::table('users')->get();
    // ====================
    // return view('dashboard', compact('users'));

    return view('admin.index');

})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');


// ubah password
Route::get('/user/password', [ChangePass::class, 'CPass'])->name('change.password');
Route::post('/password/update', [ChangePass::class, 'UpdatePass'])->name('password.update');


// Profile User
Route::get('/user/profile', [ChangePass::class, 'PUpdate'])->name('profile.update');
Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');
