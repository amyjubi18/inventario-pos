<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ShoppingCartController;
use App\Http\Controllers\Admin\ShoppingCartsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\MovementController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WarehouseController;
use Laravel\Jetstream\Rules\Role;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//inventario
Route::resource('categories', CategoryController::class)->except(['show']);
Route::get('categories/import', [CategoryController::class, 'import'])->name('categories.import');

Route::resource('products', ProductController::class)->except(['show']);


Route::post('products/{product}/dropzone', [ProductController::class, 'dropzone'])->name('products.dropzone');

Route::get('products/{product}/kardex', [ProductController::class, 'kardex'])->name('products.kardex');

Route::get('products/import', [ProductController::class, 'import'])->name('products.import');

Route::resource('warehouses', WarehouseController::class)->except(['show']);
Route::get('warehouses/import', [WarehouseController::class, 'import'])->name('warehouses.import');

//Compras
Route::resource('suppliers', SupplierController::class)->except(['show']);
Route::resource('purchase_orders', PurchaseOrderController::class)->only(['index', 'create']);
Route::get('purchase_orders/{purchase_order}/pdf', [PurchaseOrderController::class, 'pdf'])->name('purchase-orders.pdf');

Route::resource('purchases', PurchaseController::class)->only(['index', 'create']);
Route::get('purchases/{purchase}/pdf', [PurchaseController::class, 'pdf'])->name('purchases.pdf');

//Ventas
Route::resource('customers', CustomerController::class)->except(['show']);
//Route::get('customers/{customer}/pdf', [CustomerController::class, 'pdf'])->name('customers.pdf');

Route::resource('quotes', QuoteController::class)->only(['index', 'create']);
Route::get('quotes/{quote}/pdf', [QuoteController::class, 'pdf'])->name('quotes.pdf');

Route::resource('sales', SaleController::class)->only(['index', 'create']);
Route::get('sales/{sale}/pdf', [SaleController::class, 'pdf'])->name('sales.pdf');

// Carrito de compras
Route::resource('shopping-carts', ShoppingCartsController::class)->except(['edit', 'update', 'show']);
Route::get('shopping-carts/{shopping_cart}/pdf', [ShoppingCartsController::class, 'pdf'])->name('shopping-carts.pdf');


//Movimientos
Route::resource('movements', MovementController::class)->only(['index', 'create']);
Route::get('movements/{movement}/pdf', [MovementController::class, 'pdf'])->name('movements.pdf');

Route::resource('transfers', TransferController::class)->only(['index', 'create']);
Route::get('transfers/{transfer}/pdf', [TransferController::class, 'pdf'])->name('transfers.pdf');

Route::resource('images', SupplierController::class)->except(['show']);


Route::delete('images/{image}', [ImageController::class, 'destroy'])
    ->name('images.destroy');

//reportes
Route::get('reports/top-products', [ReportController::class, 'topProducts'])->name('reports.top-products');
Route::get('reports/top-customers', [ReportController::class, 'topCustomers'])->name('reports.top-customers');
Route::get('reports/low-stock', [ReportController::class, 'lowStock'])->name('reports.low-stock');

//configuracion
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);

