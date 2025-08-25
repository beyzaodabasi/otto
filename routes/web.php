<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ApprovedOrderController;
use App\Http\Controllers\AssemblyController;
use App\Http\Controllers\ManufacturingController;
use App\Http\Controllers\AccountingController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagementController;

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
//Auth Logout controller
Route::group(['middleware' => 'auth'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/createUser', 'createUser')->name('createUser');
        Route::post('/logout', 'logout')->name('logout');
    });
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::get('/products/data', 'getProductsData')->name('products.data');
        Route::get('/products/newProduct', 'newProduct')->name('newProduct');
        Route::post('/products/createProduct', 'createProduct')->name('createProduct');
        Route::get('/products/getProduct/{id}', 'getProduct')->name('getProduct');
        Route::post('/products/updateProduct/{id}', 'updateProduct')->name(name: 'updateProduct');
        Route::post('importProducts', 'importProducts')->name('importProducts');
        Route::get('/products/deleteProduct/{id}', 'deleteProduct')->name('deleteProduct');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('orders');
        Route::get('/orders/data', 'getOrdersData')->name('orders.data');
        Route::get('/orders/newOrder', 'newOrder')->name('newOrder');
        Route::post('/orders/createOrder', 'createOrder')->name('createOrder');
        Route::get('/orders/getOrder/{id}', 'getOrder')->name('getOrder');
        Route::post('/orders/updateOrder/{id}', 'updateOrder')->name('updateOrder');
        Route::get('/orders/getProductsData', 'getProductsData')->name('getProductsData');
        Route::post('/orders/updateProductStatus/{id}', 'updateProductStatus')->name('updateProductStatus');
    });
    Route::controller(ApprovedOrderController::class)->group(function () {
        Route::get('/approvedOrders', 'index')->name('approvedOrders');
        Route::get('/approvedOrders/data', 'getApprovedOrdersData')->name('approvedOrders.data');
    });
    Route::controller(AssemblyController::class)->group(function () {
        Route::get('/assembly', 'index')->name('assembly');
        Route::get('/assembly/data', 'getAssemblyData')->name('assembly.data');
    });
    Route::controller(ManufacturingController::class)->group(function () {
        Route::get('/manufacturing', 'index')->name('manufacturing');
        Route::get('/manufacturing/data', 'getManufacturingData')->name('manufacturing.data');
    });
    Route::controller(AccountingController::class)->group(function () {
        Route::get('/accounting', 'index')->name('accounting');
        Route::get('/accounting/data', 'getAccountingData')->name('accounting.data');
    });
    Route::controller(ShippingController::class)->group(function () {
        Route::get('/shipping', 'index')->name('shipping');
        Route::get('/shipping/data', 'getShippingData')->name('shipping.data');
    });
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index')->name('employees');
        Route::get('/employees/data', 'getEmployeesData')->name('employees.data');
        Route::get('/employees/getEmployee/{id}', 'getEmployee')->name('getEmployee');
        Route::post('/employees/updateEmployee/{id}', 'updateEmployee')->name('updateEmployee');
    });
    Route::controller(ManagementController::class)->group(function () {
        Route::get('/management', 'index')->name('management');
    });
});
Route::group(['middleware' => 'guest'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginpost')->name('loginpost');
    });
});