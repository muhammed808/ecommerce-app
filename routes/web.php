<?php

use App\Http\Livewire\ThankYou;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\SearchComponet;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Controllers\InvoiceController;
use App\Http\Livewire\User\UserOrderDetails;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\Admin\AdminOrdersComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\Coupon\CouponComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\Coupon\CouponAddComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\Coupon\CouponEditComponent;
use App\Http\Livewire\Admin\Product\AdminProductesComponete;
use App\Http\Livewire\Admin\Category\AdminCategoriesComponent;
use App\Http\Livewire\Admin\Product\AdminAddProductesComponete;
use App\Http\Livewire\Admin\Product\AdminEditProductesComponete;
use App\Http\Livewire\Admin\Category\AdminAddCategoriesComponent;
use App\Http\Livewire\Admin\Category\AdminEditCategoriesComponent;

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


Route::get('/' , HomeComponent::class )->name("home");
Route::get('/cart' , CartComponent::class )->name('product.cart');
Route::get('product-category/{category_slug}' , CategoryComponent::class )->name('product.category');
Route::get('/search' , SearchComponet::class )->name('product.search');
Route::get('/shop' , ShopComponent::class )->name("shop");

Route::get('/details/{slug}' , DetailsComponent::class )->name('product.details');


//for admin
Route::middleware(['auth:sanctum', 'verified' , 'authrole:ADMIN'])->group(function() {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard') ;

    Route::get('/admin/orders',AdminOrdersComponent::class)->name('admin.orders');
    Route::get('/admin/orders/{order_id}',AdminOrderDetailsComponent::class)->name('admin.orders.details');

    Route::get('/admin/invoice/{order_id}',[InvoiceController::class,'index'])->name('admin.invoice');

    //categories resource
    Route::prefix('admin/categories')->group(function() {
        Route::get('/', AdminCategoriesComponent::class)->name('admin.categories') ;
        Route::get('/add', AdminAddCategoriesComponent::class)->name('categories.add') ;
        Route::get('/edit/{category_id}', AdminEditCategoriesComponent::class)->name('categories.edit') ;
    });
    //products resource
    Route::prefix('admin/products')->group(function() {
        Route::get('/', AdminProductesComponete::class)->name('admin.products') ;
        Route::get('/add', AdminAddProductesComponete::class)->name('products.add') ;
        Route::get('/edit/{product_id}', AdminEditProductesComponete::class)->name('products.edit') ;
    });
    // coupons resource
    Route::prefix('admin/coupons')->group(function() {
        Route::get('/', CouponComponent::class)->name('admin.coupons') ;
        Route::get('/add', CouponAddComponent::class)->name('coupons.add') ;
        Route::get('/edit/{coupon_id}', CouponEditComponent::class)->name('coupons.edit') ;
    });

});

//for usre
Route::middleware(['auth:sanctum', 'verified' , 'authrole:USER'])->group(function() {
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard') ;
    Route::get('/user/profile',UserProfileComponent::class)->name('user.profile') ;
    Route::get('/user/orders/{order_id}',UserOrderDetails::class)->name('user.orders.details')->middleware('orderDetails');
    Route::get('/checkout' , CheckoutComponent::class )->name("checkout");
    Route::get('/thankyou' , ThankYou::class )->name("thankyou");
});




