<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class CustomerTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Customer::query()->with(['identity']);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Tipo doc", "identity.name")
                ->sortable(),
            Column::make("Num Doc", "document_number")
                ->sortable()
                ->searchable(),
            Column::make("Razon Social", "name")
                ->sortable()
                ->searchable(),
            Column::make("Correo", "email")
                ->sortable()
                ->searchable(),
            Column::make("Telefono", "phone")
                ->sortable()
                ->searchable(),
           Column::make('Acciones')
            ->label(function($row){
                return view('admin.customers.actions', [
                    'customer' => $row,
                ]);
            })
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

        $customers = count($selected) ? Customer::whereIn('id', $selected)
        ->with(['identity'])
        ->get() : Customer::with(['identity'])->get();

        return Excel::download(new \App\Exports\CustomersExport($customers), 'customers.xlsx');


    }



}
