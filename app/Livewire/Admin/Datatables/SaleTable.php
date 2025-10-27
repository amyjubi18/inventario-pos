<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfSend;
use Maatwebsite\Excel\Facades\Excel;

class SaleTable extends DataTableComponent
{
    protected $model = Sale::class;

    public function builder(): Builder
    {
        return Sale::query()->with([ 'customer']);
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setAdditionalSelects(['sales.id']);
        $this->setPerPage(10);
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

            Column::make("Document", "customer.document_number")
                ->sortable(),
            Column::make("Razon Social", "customer.name")
                ->sortable(),
            Column::make("Total", "total")
                ->sortable()
                ->format(fn($value)=> 'S/ '. number_format($value, 2,'.',',')),

            Column::make('Acciones')
            ->label(function($row){
                return view('admin.sales.actions', [
                    'sale' => $row,
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

        $sales = count($selected) ? Sale::whereIn('id', $selected)
        ->with(['customer.identity'])
        ->get() : Sale::with(['customer.identity'])->get();
        // ->with(['customer']) --- IGNORE ---
        // ->get() : Sale::with(['customer'])->get(); --- IGNORE ---

        return Excel::download(new \App\Exports\SalesExport($sales), 'sales.xlsx');
    }


    //propiedades
    public $form =[
        'open' => false,
        'email' => '',
        'document' => '',
        'client' => '',
        'model' => null,
        'view_pdf_patch' => 'admin.sales.pdf',
    ];

    //metodo
    public function openModal(Sale $sale){
        $this->form['email'] = $sale->customer->email;
        $this->form['open'] = true;
        $this->form['document'] = 'Venta '. $sale->serie .'-'. $sale->correlative;
        $this->form['client'] = $sale->customer->document_number . ' - ' . $sale->customer->name;
        $this->form['model'] = $sale;
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
