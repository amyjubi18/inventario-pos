<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfSend;
use Maatwebsite\Excel\Facades\Excel;

class PurchaseTable extends DataTableComponent
{
    protected $model = Purchase::class;

    public function builder(): Builder
    {
        return Purchase::query()->with(['supplier']);
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setAdditionalSelects(['purchases.id']);
        $this->setConfigurableAreas([
            'after-wrapper' => [
                'pdf.modal'
            ]
        ]);
    }

    public function filters():array{
        return [
            DateRangeFilter::make('Fecha')
                ->config([
                    'placeholder' => 'Seleccionar rango de fecha',
                    /* 'min' => '2023-01-01',
                    'max' => Carbon::now()->format('Y-m-d'),
                    'format' => 'Y-m-d', */
                ])
                ->filter(function($query, $dateRange) {

                   $query->whereBetween('date', [
                    $dateRange['minDate'],
                    $dateRange['maxDate']
                ]);
            }),
            MultiSelectFilter::make('Proveedor')
            ->options(
                Supplier::query()
                    ->orderBy('name')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($tag) => $tag->name)
                    ->toArray()
            )
            ->filter(function($query, array $selected) {
                $query->whereIn('supplier_id', $selected);
            }),
        ];
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Fecha", "date")
                ->sortable()
                ->format(function($value) {
                    if (is_string($value)) {
                        try {
                            return Carbon::parse($value)->format('Y-m-d');
                        } catch (\Exception $e) {
                            return $value;
                        }
                    }
                    return $value->format('Y-m-d');
                }),
            Column::make("Serie", "serie")
                ->sortable(),
            Column::make("Correlativo", "correlative")
                ->sortable(),

            Column::make("Document", "supplier.document_number")
                ->sortable(),
            Column::make("Razon Social", "supplier.name")
                ->sortable()
                ->searchable(),
            Column::make("Total", "total")
                ->sortable()
                ->format(fn($value)=> 'S/ '. number_format($value, 2,'.',',')),

            Column::make('Acciones')
            ->label(function($row){
                return view('admin.purchases.actions', [
                    'purchase' => $row,
                ]);
            })->sortable()

        ];
    }
    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Exportar',
        ];
    }

    public function exportSelected()
    {
        $selected = $this->getSelected();

        $purchases = count($selected) ? Purchase::whereIn('id', $selected)
        ->with(['supplier.identity'])
        ->get() : Purchase::with(['supplier.identity'])->get();

        return Excel::download(new \App\Exports\PurchasesExport($purchases), 'purchases.xlsx');
    }


    //propiedades
    public $form =[
        'open' => false,
        'email' => '',
        'document' => '',
        'client' => '',
        'model' => null,
        'view_pdf_patch' => 'admin.purchases.pdf',
    ];

    //metodo
    public function openModal(Purchase $purchase){
        $this->form['email'] = $purchase->supplier->email;
        $this->form['open'] = true;
        $this->form['document'] = 'Compra '. $purchase->serie .'-'. $purchase->correlative;
        $this->form['client'] = $purchase->supplier->document_number . ' - ' . $purchase->supplier->name;
        $this->form['model'] = $purchase;
    }
    public function sendEmail(){

        $this->validate([
            'form.email' => 'required|email',

        ]);

        //llamar a un mailable
        Mail::to($this->form['email'])->send(new PdfSend($this->form));
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Correo enviado con exito',
            'text' => 'El correo ha sido enviado al correo',
        ]);
        $this->reset('form');
    }
}
