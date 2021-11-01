<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    return view('home', compact('brands','abouts'));
});

Route::get('/about', function () {
    return view('about');
});


Route::get('/contact', [ContactController::class, 'index'])->name('con');


//Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
//Add Category
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
//Edit Category
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
//Update Category Name
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
//Delete Category Route
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
//Restore Deleted Category Route
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
//Permanent Delete Route
Route::get('/pdelete/category/{id}', [CategoryController::class, 'Pdelete']);
//For Brand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');

Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);

Route::post('/brand/update/{id}', [BrandController::class, 'Update']);

Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

// For uploading multiple images in databes

Route::get('/multi/image', [BrandController::class, 'Multpic'])->name('multi.image');
Route::post('/multi/add/', [BrandController::class, 'StoreImg'])->name('store.image');

// Admin All Route

Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);
Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);
Route::post('/slider/update/{id}', [HomeController::class, 'Update']);

// Home About all route
Route::get('/home/About', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/About', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/About', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);


// Home Services all route
Route::get('/services/all', [ServicesController::class, 'HomeServices'])->name('home.services');
Route::post('/services/add', [ServicesController::class, 'StoreServices'])->name('store.services');
Route::get('/services/edit/{id}', [ServicesController::class, 'Edit']);
Route::post('/services/update/{id}', [ServicesController::class, 'Update']);
Route::get('/services/delete/{id}', [ServicesController::class, 'Delete']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //    $users = user::all();
    //  $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

