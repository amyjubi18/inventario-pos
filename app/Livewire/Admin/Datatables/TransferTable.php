<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Transfer;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfSend;
use Maatwebsite\Excel\Facades\Excel;

class TransferTable extends DataTableComponent
{
    protected $model = Transfer::class;

    public function builder(): Builder
    {
        return Transfer::query()->with(['originWarehouse', 'destinationWarehouse']);
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setAdditionalSelects(['transfers.id']);
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

            Column::make("Almacen Origen", "originWarehouse.name")
                ->sortable(),
            Column::make("Almacen Destino", "destinationWarehouse.name")
                ->sortable(),


            Column::make("Total", "total")
                ->sortable()
                ->format(fn($value)=> 'S/ '. number_format($value, 2,'.',',')),

            Column::make('Acciones')
            ->label(function($row){
                return view('admin.transfers.actions', [
                    'transfer' => $row,
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

        $transfers = count($selected) ? Transfer::whereIn('id', $selected)
        ->with(['originWarehouse', 'destinationWarehouse'])
        ->get() : Transfer::with(['originWarehouse', 'destinationWarehouse'])->get();

                return Excel::download(new \App\Exports\TransfersExport($transfers), 'transfers.xlsx');

    }

    //propiedades
    public $form =[
        'open' => false,
        'email' => '',
        'document' => '',
        'client' => '',
        'model' => null,
        'view_pdf_patch' => 'admin.transfers.pdf',
    ];

    //metodo
    public function openModal(Transfer $transfer){
        $this->form['email'] = '';
        $this->form['open'] = true;
        $this->form['document'] = 'Transferencia '. $transfer->serie .'-'. $transfer->correlative;
        $this->form['client'] = $transfer->originWarehouse->name ;
        $this->form['model'] = $transfer;
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
