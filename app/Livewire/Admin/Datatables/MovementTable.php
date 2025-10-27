<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Movement;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfSend;
use Maatwebsite\Excel\Facades\Excel;

class MovementTable extends DataTableComponent
{
    protected $model = Movement::class;

    public function builder(): Builder
    {
        return Movement::query()->with(['warehouse', 'reason']);
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
        $this->setAdditionalSelects(['movements.id']);
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
                Column::make("Tipo", "type")
                ->sortable()
                ->format(
                    fn($value) => match($value){
                        1 => 'Ingreso',
                        2 => 'Salida',
                        default => 'Desconocido'
                    }
                ),
            Column::make("Serie", "serie")
                ->sortable(),
            Column::make("Correlativo", "correlative")
                ->sortable(),

            Column::make("Almacen", "warehouse.name")
                ->sortable(),
            Column::make("Motivo", "reason.name")
                ->sortable(),

            Column::make("Total", "total")
                ->sortable()
                ->format(fn($value)=> 'S/ '. number_format($value, 2,'.',',')),

            Column::make('Acciones')
            ->label(function($row){
                return view('admin.movements.actions', [
                    'movement' => $row,
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

        $movements = count($selected) ? Movement::whereIn('id', $selected)
        ->with(['warehouse', 'reason'])
        ->get() : Movement::with(['warehouse', 'reason'])->get();

                return Excel::download(new \App\Exports\MovementsExport($movements), 'movements.xlsx');

    }

    //propiedades
    public $form =[
        'open' => false,
        'email' => '',
        'document' => '',
        'client' => '',
        'model' => null,
        'view_pdf_patch' => 'admin.movements.pdf',
    ];

    //metodo
    public function openModal(Movement $movement){
        $this->form['email'] = '';
        $this->form['open'] = true;
        $this->form['document'] = 'Movimiento '. $movement->serie .'-'. $movement->correlative;
        $this->form['client'] = $movement->warehouse->name;
        $this->form['model'] = $movement;
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
