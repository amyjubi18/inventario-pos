<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class LowStockTable extends DataTableComponent
{

    public function builder(): Builder
    {
        return Product::query()
        ->where('stock', '>=', 0)
        ->where('stock', '<', 10)
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->selectRaw('
        products.id as id,
        products.name as name,
        products.description as description,
        products.stock as stock,
        categories.name as category_name,
        (10 - products.stock) as faltante
        ');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('stock', 'asc');
    }

    public function columns(): array
    {

        return [
                Column::make("Id")
                ->label(function($row){
                return $row->id;
                }),
                Column::make("Producto")
                ->label(function($row){
                return $row->name;
                })
                ->sortable(function($query, $direction){
                    return $query->orderBy('name', $direction);
                })->searchable(function($query, $search){
                    return $query->orWhere('products.name', 'like', '%'.$search.'%');
                }),

                Column::make("Stock Actual")
                ->label(function($row){
                return $row->stock;
                })
                ->sortable(function($query, $direction){
                    return $query->orderBy('stock', $direction);
                }),
                Column::make("Stock Mínimo")
                ->label(function($row){
                return 10;
                }),
                Column::make("Faltante")
                ->label(function($row){
                return $row->faltante;
                })
                ->sortable(function($query, $direction){
                    return $query->orderBy('faltante', $direction);
                })

        ];
    }
}
