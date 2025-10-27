<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Customer;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Ventas del mes actual
        $salesThisMonth = ShoppingCart::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('total');

        // Compras del mes actual
        $purchasesThisMonth = Purchase::whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->sum('total');

        // Cantidad de productos registrados
        $totalProducts = Product::count();

        // Stock total de todos los productos
        $totalStock = abs(Product::sum('stock'));

        // Cantidad de clientes registrados
        $totalCustomers = Customer::count();

        // Datos para gráfica de ventas por día (todos los tiempos)
        $salesByDay = Sale::selectRaw('DATE(date) as day, SUM(total) as total')
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->pluck('total', 'day')
            ->toArray();

        // Top 5 productos más vendidos
        $topProducts = DB::table('productables')
            ->join('products', 'productables.product_id', '=', 'products.id')
            ->where('productable_type', 'App\Models\Sale')
            ->selectRaw('products.name, SUM(productables.quantity) as total_quantity')
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();

        // Datos para gráfica de shopping carts por día
        $shoppingCartsByDay = ShoppingCart::selectRaw('DATE(created_at) as day, SUM(total) as total')
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->pluck('total', 'day')
            ->toArray();

        // Top 5 productos más vendidos en shopping carts
        $shoppingCarts = ShoppingCart::all();
        $productQuantities = [];
        foreach ($shoppingCarts as $cart) {
            if ($cart->products) {
                foreach ($cart->products as $product) {
                    $name = $product['name'] ?? '';
                    $qty = $product['quantity'] ?? 0;
                    if (!isset($productQuantities[$name])) {
                        $productQuantities[$name] = 0;
                    }
                    $productQuantities[$name] += $qty;
                }
            }
        }
        $topProductsShopping = collect($productQuantities)->sortByDesc(function($qty) {
            return $qty;
        })->take(5)->map(function($qty, $name) {
            return (object)['name' => $name, 'total_quantity' => $qty];
        })->values();

        return view('admin.dashboard', compact(
            'salesThisMonth',
            'purchasesThisMonth',
            'totalProducts',
            'totalStock',
            'totalCustomers',
            'salesByDay',
            'topProducts',
            'shoppingCartsByDay',
            'topProductsShopping'
        ));
    }
}
