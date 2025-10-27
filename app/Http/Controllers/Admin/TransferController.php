<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\Transfer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read-transfers');
        return view('admin.transfers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-transfers');
        return view('admin.transfers.create');
    }


    public function pdf(Transfer $transfer)
    {
        Gate::authorize('read-transfers');
        $pdf = Pdf::loadView('admin.transfers.pdf', [
            'model' => $transfer
        ]);
        return $pdf->download("transferencia_{$transfer->id}.pdf");
    }
}
