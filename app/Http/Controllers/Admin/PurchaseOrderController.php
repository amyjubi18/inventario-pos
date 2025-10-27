<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read-purchase_orders');
        return view('admin.purchase_orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-purchase_orders');
        return view('admin.purchase_orders.create');
    }
    public function pdf(PurchaseOrder $purchaseOrder)
    {
        Gate::authorize('read-purchase_orders');
        $pdf = Pdf::loadView('admin.purchase-orders.pdf', [
            'model' => $purchaseOrder
        ]);
        return $pdf->download("orden_compra_{$purchaseOrder->id}.pdf");
    }
}
