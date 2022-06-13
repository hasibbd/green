<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\InvoiceController;
use App\Http\Controllers\LimitController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StoreAppController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\UserAppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorOrderListController;
use App\Http\Controllers\VendorProductController;
use Illuminate\Support\Facades\Artisan;
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
Route::get('/create-symlink', function () {
    Artisan::call('storage:link');
});
Route::middleware(['admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('admin-user-list', [UserController::class, 'aindex'])->name('admin-user-list.index');
    Route::get('store-user-list', [UserController::class, 'sindex'])->name('store-user-list.index');
    Route::get('user-list', [UserController::class, 'uindex'])->name('user-list.index');

    Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
    Route::post('slider-store', [SliderController::class, 'store']);
    Route::get('slider-show/{id}', [SliderController::class, 'edit']);
    Route::get('slider-status/{id}', [SliderController::class, 'status']);
    Route::delete('slider-delete/{id}', [SliderController::class, 'destroy']);

    Route::get('user-application-list', [UserAppController::class, 'index'])->name('user-application-list.index');
    Route::get('user-application-list-show/{id}', [UserAppController::class, 'edit']);
    Route::get('user-application-list-status/{id}', [UserAppController::class, 'status']);
    Route::delete('user-application-list-delete/{id}', [UserAppController::class, 'destroy']);


    Route::get('store-application-list', [StoreAppController::class, 'index'])->name('store-application-list.index');
    Route::get('store-application-list-show/{id}', [StoreAppController::class, 'edit']);
    Route::get('store-application-list-status/{id}', [StoreAppController::class, 'status']);
    Route::delete('store-application-list-delete/{id}', [StoreAppController::class, 'destroy']);

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

    Route::get('flying-user-list', [UserController::class, 'findex'])->name('flying-user-list.index');
    Route::post('store-user-store', [UserController::class, 'store3']);
    Route::post('user-store', [UserController::class, 'store2']);
    Route::get('user-show/{id}', [UserController::class, 'edit']);
    Route::get('user-status/{id}', [UserController::class, 'status']);
    Route::delete('user-delete/{id}', [UserController::class, 'destroy']);

    Route::get('product-list', [ProductController::class, 'index'])->name('product-list.index');
    Route::post('product-store', [ProductController::class, 'store']);
    Route::get('product-show/{id}', [ProductController::class, 'edit']);
    Route::get('product-status/{id}', [ProductController::class, 'status']);
    Route::delete('product-delete/{id}', [ProductController::class, 'destroy']);

    // order list
   // Route::get('order-list', [OrderController::class, 'showOrderList'])->name('order-list.index');
    Route::get('order-list', [VendorOrderListController::class, 'showSellerOrderList'])->name('order-list.index');
    Route::get('admin-seller-order-list-details/{id}', [VendorOrderListController::class, 'showSellerOrderDetailsList']);
    //Setting
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('setting-show/{id}', [SettingController::class, 'edit']);
    Route::post('setting-store', [SettingController::class, 'store']);

    //Generation Setting
    Route::get('generation-setting', [GenerationController::class, 'index'])->name('generation-setting.index');
    Route::get('generation-setting-show/{id}', [GenerationController::class, 'edit']);
    Route::post('generation-setting-store', [GenerationController::class, 'store']);

    Route::post('add-limit', [LimitController::class, 'store']);

    Route::get('point-account', [AccountController::class, 'pointAccount'])->name('point-account.index');
    Route::get('store-manager-account', [AccountController::class, 'storeManagerAccount'])->name('store-manager-account.index');
    Route::get('user-account', [AccountController::class, 'userAccount'])->name('user-account.index');
    Route::get('company-account', [AccountController::class, 'companyAccount'])->name('company-account.index');
    Route::get('user-reserve-account', [AccountController::class, 'userReserve'])->name('user-reserve-account.index');
});

Route::middleware(['user'])->group(function () {
    Route::post('basic-update', [UserController::class, 'basicUpdate']);
    Route::post('pass-update', [UserController::class, 'passUpdate']);
    Route::get('my-profile', [HomeController::class, 'profile'])->name('my-profile.index');
    Route::get('change-password', [HomeController::class, 'changePass']);
    // for invoice routes here
    Route::get('invoice-show', [InvoiceController::class, 'invoiceShow'])->name('invoice.show');
    Route::get('order-show', [InvoiceController::class, 'orderShow'])->name('order.show');
    Route::get('user-application', [UserController::class, 'userRegistration']);
    Route::post('user-reg-create', [UserController::class, 'RegStore']);
    Route::post('store-application-store', [StoreAppController::class, 'store']);
    Route::get('product-accept/{id}', [VendorOrderListController::class, 'ProductAccept']);
    Route::get('product-accept-all/{id}', [VendorOrderListController::class, 'ProductAcceptAll']);
    Route::get('product-accept-all-can/{id}', [VendorOrderListController::class, 'ProductAcceptAllCan']);
    Route::get('check-code/{code}', [UserController::class, 'CodeCheck']);
    Route::get('user-generation/{gen}/{user}', [App\Http\Controllers\Front\GenerationController::class, 'index']);
});

Route::get('login', [AuthController::class, 'login'])->name('/');
Route::get('check-ref', [AuthController::class, 'checkRef']);
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
Route::get('read/{id}', [HomeController::class, 'read']);
Route::get('article-list', [HomeController::class, 'Allread']);
Route::get('terms', [HomeController::class, 'terms']);

Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('decrease/{id}', [CartController::class, 'decreseCart'])->name('decrease.to.cart');
Route::get('update-qty', [CartController::class, 'updateQtyCart'])->name('update-qty.to.cart');
Route::get('get-cart', [CartController::class, 'getCart'])->name('get.cart');
Route::get('remove/{id}', [CartController::class, 'remove'])->name('remove.cart');
Route::get('check-out', [CheckoutController::class, 'checkOut'])->name('check-out');
Route::post('store-order', [CheckoutController::class, 'storeOrder'])->name('store.order');




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


    // order list
    Route::get('seller-order-list', [VendorOrderListController::class, 'showSellerOrderList'])->name('seller-order-list.index');
    Route::get('seller-order-list-details/{id}', [VendorOrderListController::class, 'showSellerOrderDetailsList']);
    Route::get('product-deliver/{id}', [VendorOrderListController::class, 'ProductDeliver']);
    Route::get('product-deliver-all/{id}', [VendorOrderListController::class, 'ProductDeliverAll']);
    Route::get('product-cancel/{id}', [VendorOrderListController::class, 'ProductCancel']);

    Route::get('limit-list', [LimitController::class, 'index'])->name('limit-list.index');
});
Route::get('try', [HomeController::class, 'userCreate']);
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile-info-change', [ProfileController::class, 'update']);
Route::get('test', [TestController::class, 'index']);
