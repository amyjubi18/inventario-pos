<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read-quotes');
        return view('admin.quotes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-quotes');
        return view('admin.quotes.create');
    }

    public function pdf(Quote $quote)
    {
        Gate::authorize('read-quotes');
        $pdf = Pdf::loadView('admin.quotes.pdf', [
            'model' => $quote
        ]);
        return $pdf->download("cotizacion_{$quote->id}.pdf");
    }
}
