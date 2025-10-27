<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class SupplierTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Supplier::query()->with(['identity']);
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
                return view('admin.suppliers.actions', [
                    'supplier' => $row,
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

        $suppliers = count($selected) ? Supplier::whereIn('id', $selected)
        ->with(['identity'])
        ->get() : Supplier::with(['identity'])->get();

        return Excel::download(new \App\Exports\SuppliersExport($suppliers), 'suppliers.xlsx');


    }


}
