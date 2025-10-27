<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class ShoppingCartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.shopping-carts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shopping-carts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    /* public function show(ShoppingCart $shoppingCart)
    {
        return view('admin.shopping-carts.show', compact('shoppingCart'));
    }
 */
    /**
     * Show the form for editing the specified resource.
     */
    /* public function edit(string $id)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingCart $shoppingCart)
    {
        $shoppingCart->delete();

        return redirect()->route('admin.shopping-carts.index')->with('success', 'Carrito de compras eliminado correctamente');
    }

    public function pdf(ShoppingCart $shoppingCart)
    {
        Gate::authorize('read-sales');
        $pdf = Pdf::loadView('admin.shopping-carts.pdf', [
            'model' => $shoppingCart
        ]);
        return $pdf->download("carrito_compras_{$shoppingCart->id}.pdf");
    }
}
