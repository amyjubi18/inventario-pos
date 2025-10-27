<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfSend;
use Maatwebsite\Excel\Facades\Excel;

class QuoteTable extends DataTableComponent
{
    protected $model = Quote::class;

    public function builder(): Builder
    {
        return Quote::query()->with(['customer']);
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setAdditionalSelects(['quotes.id']);
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
                return view('admin.quotes.actions', [
                    'quote' => $row,
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

        $quotes = count($selected) ? Quote::whereIn('id', $selected)
        ->with(['customer.identity'])
        ->get() : Quote::with(['customer.identity'])->get();

        return Excel::download(new \App\Exports\QuotesExport($quotes), 'quotes.xlsx');
    }

    //propiedades
    public $form =[
        'open' => false,
        'email' => '',
        'document' => '',
        'client' => '',
        'model' => null,
        'view_pdf_patch' => 'admin.quotes.pdf',
    ];

    //metodo
    public function openModal(Quote $quote){
        $this->form['email'] = $quote->customer->email;
        $this->form['open'] = true;
        $this->form['document'] = 'Cotizacion '. $quote->serie .'-'. $quote->correlative;
        $this->form['client'] = $quote->customer->document_number . ' - ' . $quote->customer->name;
        $this->form['model'] = $quote;
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
