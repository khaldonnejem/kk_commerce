<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SiteController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {
// });

Route::prefix(LaravelLocalization::setLocale())->group(function () {


    Route::prefix('admin')->name('admin.')->middleware('auth', 'user_type','verified')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        // Route::get('/{locale?}',[AdminController::class,'index'])->name('index');

        Route::resource('categories',CategoryController::class);
        // Route::get('categories',[CategoryController::class,'index']);

        Route::resource('products',ProductController::class);
        Route::get('delete-image/{id}', [ProductController::class, 'delete_image'])->name('products.delete_image');

        Route::get('users',[UserController::class, 'index'])->name('users.index');
        Route::delete('users/{id}',[UserController::class, 'destroy'])->name('users.destroy');

    });
});


// Auth::routes(['verify' => true , 'register' => false]);

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('no-access','no_access');

//Site Routes
//this was just for test
// Route::get('/', function () {
//     return 'home';
// })->name('site.index');


Route::get('/',[SiteController::class, 'index'])->name('site.index');
