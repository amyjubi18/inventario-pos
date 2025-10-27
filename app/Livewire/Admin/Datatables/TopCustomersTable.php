<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;

class TopCustomersTable extends DataTableComponent
{

    public function builder(): Builder
    {
        return Sale::query()
        ->join('customers', 'sales.customer_id', '=', 'customers.id')
        ->join('identities', 'customers.identity_id', '=', 'identities.id')
        ->selectRaw(
            '
            customers.id as id,
            customers.name as name,
            customers.email as email,
            identities.name as identity_type,
            customers.document_number as document_number,
            COUNT(sales.id) as total_sales,
            SUM(sales.total) as total_amount
            '
        )
        ->groupBy('customers.id',
        'customers.name',
        'customers.email',
        'identities.name',
        'customers.document_number'
        )
        ;

    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('total_amount', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id")
                ->label(function($row){
                return $row->id;
                })
                ->sortable(),
                Column::make("Cliente")
                ->label(function($row){
                return $row->name;
                })
                ->sortable(function($query, $direction){
                    return $query->orderBy('name', $direction);
                })->searchable(function($query, $search){
                    return $query->orWhere('customers.name', 'like', '%'.$search.'%');
                }),
                Column::make("Correo")
                ->label(function($row){
                return $row->email;
                }),
                Column::make("Tipo de Identidad")
                ->label(function($row){
                return $row->identity_type;
                }),
                Column::make("Numero de Documento")
                ->label(function($row){
                return $row->document_number;
                }),
                Column::make("Ventas Totales")
                ->label(function($row){
                return $row->total_sales;
                }),
                Column::make("Monto Total")
                ->label(function($row){
                return 'S/. ' . $row->total_amount;
                })

        ];
    }
}
