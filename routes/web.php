<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\InvoiceController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorProductController;
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

Route::middleware(['admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('user-list', [ListController::class, 'index'])->name('user-list.index');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile-info-change', [ProfileController::class, 'update']);

    Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::post('slider-store', [SliderController::class, 'store']);
    Route::get('slider-show/{id}', [SliderController::class, 'edit']);
    Route::get('slider-status/{id}', [SliderController::class, 'status']);
    Route::delete('slider-delete/{id}', [SliderController::class, 'destroy']);

    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('category-store', [CategoryController::class, 'store']);
    Route::get('category-show/{id}', [CategoryController::class, 'edit']);
    Route::get('category-status/{id}', [CategoryController::class, 'status']);
    Route::delete('category-delete/{id}', [CategoryController::class, 'destroy']);

    Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
    Route::post('brand-store', [BrandController::class, 'store']);
    Route::get('brand-show/{id}', [BrandController::class, 'edit']);
    Route::get('brand-status/{id}', [BrandController::class, 'status']);
    Route::delete('brand-delete/{id}', [BrandController::class, 'destroy']);

    Route::get('article', [ArticleController::class, 'index'])->name('article.index');
    Route::post('article-store', [ArticleController::class, 'store']);
    Route::get('article-show/{id}', [ArticleController::class, 'edit']);
    Route::get('article-status/{id}', [ArticleController::class, 'status']);
    Route::delete('article-delete/{id}', [ArticleController::class, 'destroy']);

    Route::get('unit', [UnitController::class, 'index'])->name('unit.index');
    Route::post('unit-store', [UnitController::class, 'store']);
    Route::get('unit-show/{id}', [UnitController::class, 'edit']);
    Route::get('unit-status/{id}', [UnitController::class, 'status']);
    Route::delete('unit-delete/{id}', [UnitController::class, 'destroy']);

    Route::get('product-list', [ProductController::class, 'index'])->name('product-list.index');
    Route::post('product-store', [ProductController::class, 'store']);
    Route::get('product-show/{id}', [ProductController::class, 'edit']);
    Route::get('product-status/{id}', [ProductController::class, 'status']);
    Route::delete('product-delete/{id}', [ProductController::class, 'destroy']);
});

Route::middleware(['user'])->group(function () {

});

Route::get('login', [AuthController::class, 'login'])->name('/');
Route::get('registration', [AuthController::class, 'registration']);
Route::get('forgot', [AuthController::class, 'forgot']);
Route::get('recover/{token}', [AuthController::class, 'recover']);

Route::post('user-create', [UserController::class, 'store']);
Route::post('user-forget', [UserController::class, 'forget']);
Route::post('reset-user-pass', [UserController::class, 'reset']);
Route::post('login-check', [DashboardController::class, 'index'])->middleware('login-check');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/{id}', [HomeController::class, 'product']);
Route::get('product-data', [HomeController::class, 'productData'])->name('product.index');
Route::get('brand-products/{id}', [HomeController::class, 'brand']);
Route::get('brand-data', [HomeController::class, 'brandData'])->name('brand-product.index');
Route::get('product-view/{id}', [HomeController::class, 'productDetails']);


Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('decrease/{id}', [CartController::class, 'decreseCart'])->name('decrease.to.cart');
Route::get('get-cart', [CartController::class, 'getCart'])->name('get.cart');
Route::get('remove/{id}', [CartController::class, 'remove'])->name('remove.cart');
Route::get('check-out', [CartController::class, 'checkOut'])->name('check-out');

// for invoice routes here
Route::get('invoice-show', [InvoiceController::class, 'invoiceShow'])->name('invoice.show');


Route::get('product-list/{id}', [HomeController::class, 'SimProduct']);
Route::get('product-list-data', [HomeController::class, 'SimProductData'])->name('productData.index');

// vendor product routes
Route::middleware(['vendor'])->group(function () {
    // vendor dashboard
    Route::get('vendor-dashboard', [DashboardController::class, 'vendorIndex'])->name('vendor-dashboard');

    Route::get('vendor-product-list', [VendorProductController::class, 'index'])->name('vendor.product.list.index');

    // my product list
    Route::get('my-product-list', [VendorProductController::class, 'myProductShow'])->name('my.product.list.index');
    Route::get('my-product-show/{id}', [VendorProductController::class, 'pedit']);
    Route::get('my-product-status/{id}', [VendorProductController::class, 'pstatus']);
    Route::delete('my-product-delete/{id}', [VendorProductController::class, 'pdestroy']);

    Route::post('vendor-product-store', [VendorProductController::class, 'store']);
    Route::post('vendor-product-stock', [VendorProductController::class, 'stock']);
    Route::post('vendor-product-edit', [VendorProductController::class, 'price']);
    Route::get('vendor-product-show/{id}', [VendorProductController::class, 'edit']);
    Route::get('get-edit-product/{id}', [VendorProductController::class, 'show']);
    Route::get('vendor-product-status/{id}', [VendorProductController::class, 'status']);
    Route::get('get-product', [VendorProductController::class, 'listData']);
    Route::delete('vendor-product-delete/{id}', [VendorProductController::class, 'destroy']);
});
