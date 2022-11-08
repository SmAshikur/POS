<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DewController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ReturnProductController;
use App\Http\Controllers\ReturnSellController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TotalController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tes', function () {
    return view('test');
});
Auth::routes();
Route::get('/hi', function () {
    return view('barcode');
});
Route::group(['middleware'=>'auth'],function(){


Route::match(array('get','post'),'/home', [HomeController::class, 'index'])->name('home');
//Route::get('/category/index', [CategoryController::class, 'index'])->name('index.category');
//Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('create.edit');
//Route::post('/strore', [CategoryController::class, 'store'])->name('store.category');
//Route::get('/brand/create', [BrandController::class, 'create'])->name('index.brand');
//Route::post('/create', [BrandController::class, 'store'])->name('createBrand');

Route::resource('category',CategoryController::class);
Route::resource('brand',BrandController::class);
Route::resource('product',ProductController::class);
Route::get('productcreate',[ProductController::class,'createProduct'])->name('product.cat');
Route::resource('purchas',PurchasesController::class);
Route::resource('sell',SellController::class);
Route::resource('contact',ContactController::class);
Route::resource('settings',SettingController::class);
Route::resource('dew',DewController::class);
Route::get('dew-sell', [DewController::class, 'indexTwo'])->name('dew.sell');
Route::get('dew-return', [DewController::class, 'indexThree'])->name('dew.return');
Route::get('dew-back', [DewController::class, 'indexFour'])->name('dew.back');
Route::resource('balance',BalanceController::class);
Route::resource('expenses',ExpensesController::class);
Route::resource('role',RoleController::class)->middleware('admin');
Route::resource('return',ReturnProductController::class);
Route::resource('payment',PaymentController::class);
Route::resource('product-return',ReturnSellController::class);
// user
Route::get('/role/{id}/edit', [AccountController::class, 'role']);;
Route::get('/user/account', [AccountController::class, 'account'])->name('account');
Route::post('/account/update/', [AccountController::class, 'update'])->name('account.ok');
Route::get('/user/change', [AccountController::class, 'passGet'])->name('passGet');
Route::post('/account/change/', [AccountController::class, 'passUp'])->name('passUp');

//ajax route for
Route::get('/get-cash', [BalanceController::class,'getCash']);
Route::get('/get-mobile-cash', [BalanceController::class,'getMobileCash']);
Route::get('/get-bank-cash', [BalanceController::class,'getBankCash']);

Route::get('/get-product', [PurchasesController::class,'getProduct']);
Route::get('/get-inv-product', [SellController::class,'getInvProduct']);
Route::get('/get-rtn-product', [ReturnProductController::class,'getRtnProduct']);
Route::get('/get-rtn-sold', [ReturnSellController::class,'getRtnSell']);
Route::get('/get-inv-sold', [ReturnSellController::class,'getSoldProduct']);
Route::get('/get-contact', [PurchasesController::class,'getContact']);
Route::get('/get-customer', [PurchasesController::class,'getCustomer']);
Route::get('/get-qty/{id}', [SellController::class,'getQty']);
Route::get('typeahead_autocomplete/action', [PurchasesController::class, 'autocomplete'])->name('autocomplete');


//pdf
Route::get('/invoice/{id}', [PurchasesController::class,'invoice'])->name('purchas.pdf');
});


Route::fallback(function(){
    return view('defult');
});
