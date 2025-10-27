<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfSend;
class PurchaseOrderTable extends DataTableComponent
{
    protected $model = PurchaseOrder::class;

    public function builder(): Builder
    {
        return PurchaseOrder::query()->with(['supplier']);
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setAdditionalSelects(['purchase_orders.id']);
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
        ];
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Fecha", "date")
                ->sortable()
                ->format(fn($value) => $value->format('Y-m-d')),
            Column::make("Serie", "serie")
                ->sortable(),
            Column::make("Correlativo", "correlative")
                ->sortable(),

            Column::make("Document", "supplier.document_number")
                ->sortable(),
            Column::make("Razon Social", "supplier.name")
                ->sortable(),
            Column::make("Total", "total")
                ->sortable()
                ->format(fn($value)=> 'S/ '. number_format($value, 2,'.',',')),

            Column::make('Acciones')
            ->label(function($row){
                return view('admin.purchase_orders.actions', [
                    'purchaseOrder' => $row,
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
    public function exportSelected(){
        $selected = $this->getSelected();

        $purchaseOrders = count($selected) ? PurchaseOrder::whereIn('id', $selected)
        ->with(['supplier.identity'])
        ->get() : PurchaseOrder::with(['supplier.identity'])->get();

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PurchaseOrdersExport($purchaseOrders), 'purchase_orders.xlsx');
    }


    //propiedades
    public $form =[
        'open' => false,
        'email' => '',
        'document' => '',
        'client' => '',
        'model' => null,
        'view_pdf_patch' => 'admin.purchase_orders.pdf',
    ];

    //metodo
    public function openModal(PurchaseOrder $purchaseOrder){
        $this->form['email'] = $purchaseOrder->supplier->email;
        $this->form['open'] = true;
        $this->form['document'] = 'Orden de Compra '. $purchaseOrder->serie .'-'. $purchaseOrder->correlative;
        $this->form['client'] = $purchaseOrder->supplier->document_number . ' - ' . $purchaseOrder->supplier->name;
        $this->form['model'] = $purchaseOrder;
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
