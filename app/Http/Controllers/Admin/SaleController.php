<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read-sales');
        return view('admin.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-sales');
        return view('admin.sales.create');
    }

    public function pdf(Sale $sale)
    {
        Gate::authorize('read-sales');
        $pdf = Pdf::loadView('admin.sales.pdf', [
            'model' => $sale
        ]);
        return $pdf->download("venta_{$sale->id}.pdf");
    }
}
