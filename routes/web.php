<?php

use App\Mail\InvoiceMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SiteController;
use App\Notifications\newOrderNotification;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\APIController;
use App\Models\Order;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {
// });

Route::prefix(LaravelLocalization::setLocale())->group(function () {


    Route::prefix('admin')->name('admin.')->middleware('auth', 'user_type','verified')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        // Route::get('/{locale?}',[AdminController::class,'index'])->name('index');

         // Categories Routes
        Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::get('categories/{id}/forcedelete', [CategoryController::class, 'forcedelete'])->name('categories.forcedelete');
        Route::resource('categories',CategoryController::class);
        // Route::get('categories',[CategoryController::class,'index']);


        // Products Routes
        Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
        Route::get('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::get('products/{id}/forcedelete', [ProductController::class, 'forcedelete'])->name('products.forcedelete');
        Route::resource('products',ProductController::class);

        //Roles
        Route::resource('roles', RoleController::class);

        //delete image
        Route::get('delete-image/{id}', [ProductController::class, 'delete_image'])->name('products.delete_image');

        // user
        Route::get('users',[UserController::class, 'index'])->name('users.index');
        Route::delete('users/{id}',[UserController::class, 'destroy'])->name('users.destroy');

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
Route::get('/about',[SiteController::class, 'about'])->name('site.about');
Route::get('/shop',[SiteController::class, 'shop'])->name('site.shop');
Route::get('/contact',[SiteController::class, 'contact'])->name('site.contact');

Route::get('/category/{id}',[SiteController::class, 'category'])->name('site.category');
Route::get('/search',[SiteController::class, 'search'])->name('site.search');
Route::get('/product/{slug}',[SiteController::class, 'product'])->name('site.product');
Route::post('/product/{slug}/review',[SiteController::class, 'product_review'])->name('site.product_review');
Route::post('/add-to-cart',[CartController::class, 'add_to_cart'])->name('site.add_to_cart');

Route::get('/cart',[CartController::class, 'cart'])->name('site.cart')->middleware('auth');
Route::post('/update-cart',[CartController::class, 'update_cart'])->name('site.update_cart')->middleware('auth');
Route::get('/cart/{id}',[CartController::class, 'remove_cart'])->name('site.remove_cart')->middleware('auth');

Route::get('/checkout',[CartController::class, 'checkout'])->name('site.checkout')->middleware('auth');
Route::get('/payment',[CartController::class, 'payment'])->name('site.payment')->middleware('auth');
Route::get('/payment/success',[CartController::class, 'success'])->name('site.success')->middleware('auth');
Route::get('/payment/fail',[CartController::class, 'fail'])->name('site.fail')->middleware('auth');

});



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('posts-api', [APIController::class, 'posts']);



// Route::get('/??????????',[SiteController::class,'khaldon']);


    include 'test.php';


