<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\Stock_inController;
use App\Http\Controllers\Backend\StockOutController;
use App\Http\Controllers\POS\PosController;
use App\Http\Controllers\Backend\ScrapController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Report\ReportController;
use App\Models\Invoice;
use App\Models\User;

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
Route::get('/logout',function()
{
    Auth::logout();
    return redirect()->back();
});

Route::group(['middleware' => ['auth']], function () {

Route::get('/',[DashboardController::class,'index'])->name('index');
Route::resource('user', UserController::class)->except(['show','destroy']);
Route::get('user/delete/{id}',[UserController::class,'destroy'])->name('user.delete');
Route::resource('role', RoleController::class);
Route::get('role/detail/{id}',[RoleController::class,'detail'])->name('role.detail');
Route::post('role/save_permission',[RoleController::class,'save_permission']);
//product
Route::resource('product', ProductController::class)->except(['destroy']);
Route::get('product/delete/{id}',[ProductController::class,'destroy'])->name('product.delete');
//Category
Route::resource('category', CategoryController::class)->except(['destroy']);
Route::get('category/delete/{id}',[CategoryController::class,'destroy'])->name('category.delete');
//units
Route::resource('/unit',UnitController::class)->except(['show','destroy']);
//stock_in
Route::get('/stock_in',[Stock_inController::class,'index'])->name('stock_in.index');
Route::get('/stock_in/create',[Stock_inController::class,'create'])->name('stock_in.create');
Route::post('stock-in/master/save', [Stock_inController::class,'save_master']);
Route::post('/stock-in/save',[Stock_inController::class,'save']);
Route::get('/stock-in/detail/{id}',[Stock_inController::class,'detail']);
Route::get('stock-in/print/{id}', [Stock_inController::class,'print']);
Route::get('stock-in/item/delete/{id}', [Stock_inController::class,'delete_item']);
Route::post('stock-in/item/save/', [Stock_inController::class,'save_item']);
Route::get('stock-in/delete/{id}', [Stock_inController::class,'delete']);
//stock_out
Route::get('/stock_out',[StockOutController::class,'index'])->name('stock_out.index');
Route::get('/stock_out/create',[StockOutController::class,'create'])->name('stock_out.create');
Route::post('stock-out/master/save', [StockOutController::class,'save_master']);
Route::post('/stock-out/save',[StockOutController::class,'save']);
Route::get('/stock-out/detail/{id}',[StockOutController::class,'detail']);
Route::get('stock-out/print/{id}', [StockOutController::class,'print']);
Route::get('stock-out/item/delete/{id}', [StockOutController::class,'delete_item']);
Route::post('stock-out/item/save/', [StockOutController::class,'save_item']);
Route::get('stock-out/delete/{id}', [StockOutController::class,'delete']);

//scraps
Route::get('/scrap',[ScrapController::class,'index'])->name('scrap.index');
Route::get('/scrap/create',[ScrapController::class,'create'])->name('scrap.create');
Route::post('scrap/master/save', [ScrapController::class,'save_master']);
Route::post('/scrap/save',[ScrapController::class,'save']);
Route::get('/scrap/detail/{id}',[ScrapController::class,'detail']);
Route::get('scrap/print/{id}', [ScrapController::class,'print']);
Route::get('scrap/item/delete/{id}', [ScrapController::class,'delete_item']);
Route::post('scrap/item/save/', [ScrapController::class,'save_item']);
Route::get('scrap/delete/{id}', [ScrapController::class,'delete']);

//pos
Route::get('pos',[PosController::class,'index'])->name('pos.index');
Route::post('pos/get',[PosController::class,'get'])->name('pos.get');
Route::post('pos/save',[PosController::class,'save']);
Route::get('pos/invoice/{id}',[PosController::class,'invoice']);

//report

Route::get('/report',[ReportController::class,'report'])->name('report.index');
Route::get('/report/stock-out',[ReportController::class,'stockOut'])->name('report.stock_out');
Route::get('/report/stock-in',[ReportController::class,'stockIn'])->name('report.stock_in');

//invoice
Route::resource('/invoice', InvoiceController::class)->except(['create','destroy']);
Route::get('/invoice/delete/{id}',[InvoiceController::class,'destroy']);
});
