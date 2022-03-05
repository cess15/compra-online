<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::group(['middleware' => ['guest']], function () {
	//User guest
	Route::get('/', [LoginController::class, 'formLogin']);
	Route::post('/login', [LoginController::class, 'login']);
});


Route::group(['middleware' => ['auth']], function () {
	//User auth
	Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
	Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/all', [ProductController::class, 'findAll'])->name('products.data');
    //Ventas de Productos
	Route::get('/products/sales', [SaleProductController::class, 'findAll'])->name('products.sales.data');


});

Route::group(['middleware' => ['auth', 'administrator']], function () {


    //Categoria
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
	Route::get('/categories/all', [CategoryController::class, 'findAll'])->name('categories.data');

    //Products
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    //Sellers
    Route::get('/sellers', [SellerController::class, 'index'])->name('sellers.index');
    Route::get('/sellers/all', [SellerController::class, 'findAll'])->name('sellers.data');

    //Buyers
    Route::get('/buyers', [BuyerController::class, 'index'])->name('buyers.index');
    Route::get('/buyers/all', [BuyerController::class, 'findAll'])->name('buyers.data');

});

//Sellers
Route::group(['middleware' => ['auth', 'seller']], function () {
    Route::post('/sellers/products', [SellerController::class, 'create'])->name('sellers.create');
    Route::get('/sellers/{value}/products', [SellerController::class, 'productsSoldBySeller'])->name('sellers.products');

    Route::post('products/{product}/sell', [SaleProductController::class, 'store'])->name('saleProduct.sell');

});

//Buyers
Route::group(['middleware' => ['auth', 'buyer']], function () {
    Route::get('/buyers/{value}/buyer', [BuyerController::class, 'productsBoughtByBuyer'])->name('buyers.products');
    Route::post('products/{product}/buy', [SaleProductController::class, 'store'])->name('saleProduct.buy');
    Route::post('products/{product}/validate', [SaleProductController::class, 'validateBuy'])->name('saleProduct.validate');

});
