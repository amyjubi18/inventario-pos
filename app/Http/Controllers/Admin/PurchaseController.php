<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read-purchases');
        return view('admin.purchases.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-purchases');
        return view('admin.purchases.create');
    }
    public function pdf(Purchase $purchase)
    {
        Gate::authorize('read-purchases');
        $pdf = Pdf::loadView('admin.purchases.pdf', [
            'model' => $purchase
        ]);
        return $pdf->download("compra_{$purchase->id}.pdf");
    }
}
