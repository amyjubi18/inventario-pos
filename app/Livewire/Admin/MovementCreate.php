<?php

namespace App\Livewire\Admin;

use App\Facades\Kardex;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Movement;
use App\Services\KardexService;
use BaconQrCode\Renderer\Path\Move;
use Livewire\Component;

class MovementCreate extends Component
{
    public $type = 1;
    public $serie = 'M001';
    public $correlative;
    public $date;
    public $warehouse_id;
    public $reason_id;
    public $total =0;
    public $observation;

    public $product_id;

    public $products = [];


    public function boot(){
        $this->withValidator(function ($validator){
            if($validator->fails()){
                $errors = $validator->errors()->toArray();
                $html = "<ul class='text-left'>";

                foreach($errors as $error){
                    $html .= "<li>{$error[0]}</li>";

                }
                $html .= "</ul>";

                $this->dispatch('swal',[
                    'icon' => 'error',
                    'title' => 'Error de validación',
                    'html' => $html
                ]);

            }
        });
    }
    public function mount(){
        $this->correlative = Movement::max('correlative') + 1;
    }

    public function updated($property, $value){
        if($property == 'type'){
            $this->reset('reason_id');

        }

    }

    public function addProduct(){
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id'
        ],[],[
            'product_id' => 'producto',
            'warehouse_id' => 'almacen'
        ]);

        $existing = collect($this->products)
                    ->firstWhere('id', $this->product_id);

        if($existing){
            $this->dispatch('swal',[
                'icon' => 'warning',
                'title' => 'Producto ya agregado',
                'text' => 'El producto ya se encuentra en la lista'
            ]);
            return;
        }



        $product = Product::find($this->product_id);
        $lastRecord = Inventory::where('product_id', $product->id)
                ->where('warehouse_id', $this->warehouse_id)
                ->latest('id')
                ->first();

        $costBalance = $lastRecord?->cost_balance ?? 0;

        $this->products[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $costBalance,
            'quantity' => 1,
            'subtotal' => 1 * $costBalance,
        ];

        $this->calculateTotal();

        $this->reset('product_id');


    }

    public function calculateTotal(){
        $this->total = collect($this->products)->sum(function($product){
            return $product['quantity'] * $product['price'];
        });
    }

    public function save(){
        $this->validate([
            'type' => 'required|in:1,2',
            'serie' => 'required|string|max:10',
            'correlative' => 'required|numeric|min:1',
            'date' => 'nullable|date',
            'warehouse_id' => 'required|exists:warehouses,id',
            'reason_id' => 'required|exists:reasons,id',
            'total' => 'required|numeric|min:0',
            'observation' => 'nullable|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ],[],[
            'type' => 'Tipo de comprobante',
            'warehouse_id' => 'Alamacen',
            'reason_id' => 'Motivo',
            'observation' => 'Observaciones',
            'products.*.id' => 'Producto',
            'products.*.quantity' => 'Cantidad',
            'products.*.price' => 'Precio'
        ]);

        $movement = Movement::create([
            'type' => $this->type,
            'serie' => $this->serie,
            'correlative' => $this->correlative,
            'date' => $this->date ?? now(),
            'warehouse_id' => $this->warehouse_id,
            'reason_id' => $this->reason_id,
            'total' => $this->total,
            'observation' => $this->observation
        ]);

        foreach($this->products as $product){
            $movement->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['quantity'] * $product['price']
            ]);

           /*  $lastRecord = Inventory::where('product_id', $product['id'])
                ->where('warehouse_id', $this->warehouse_id)
                ->latest('id')
                ->first();
            $lastQuantityBalance = $lastRecord?->quantity_balance ?? 0;
            $lastTotalBalance = $lastRecord?->total_balance ?? 0;

            $inventory = new Inventory();
            $inventory->inventoryable_type = Movement::class;
            $inventory->inventoryable_id = $movement->id;
            $inventory->product_id = $product['id'];
            $inventory->warehouse_id = $this->warehouse_id;
            $inventory->detail = 'Movimiento'; */
/*


            if($this->type == 1){
                $newQuantityBalance = $lastQuantityBalance + $product['quantity'];
                $newTotalBalance = $lastTotalBalance + ($product['quantity'] * $product['price']);

                $inventory->quantity_in = $product['quantity'];
                $inventory->cost_in = $product['price'];
                $inventory->total_in = $product['quantity'] * $product['price']; */


                //$newCostBalance = $newTotalBalance / ($newQuantityBalance ?: 1);

                /* $movement->inventories()->create([
                'detail' => 'Movimiento',
                'quantity_in' => $product['quantity'],
                'cost_in' => $product['price'],
                'total_in' => $product['quantity'] * $product['price'],
                'quantity_balance' => $newQuantityBalance,
                'total_balance' => $newTotalBalance,
                'cost_balance' => $newCostBalance,
                'product_id' => $product['id'],
                'warehouse_id' => $this->warehouse_id,
                ]); */

           /*  }elseif($this->type == 2){
                $newQuantityBalance = $lastQuantityBalance - $product['quantity'];
                $newTotalBalance = $lastTotalBalance - ($product['quantity'] *  $product['price']);

                $inventory->quantity_out = $product['quantity'];
                $inventory->cost_out = $product['price'];
                $inventory->total_out = $product['quantity'] * $product['price']; */

                /* $movement->inventories()->create([
                'detail' => 'Movimiento',
                'quantity_out' => $product['quantity'],
                'cost_out' => $product['price'],
                'total_out' => $product['quantity'] * $product['price'],
                'quantity_balance' => $newQuantityBalance,
                'total_balance' => $newTotalBalance,
                'cost_balance' => $newCostBalance,
                'product_id' => $product['id'],
                'warehouse_id' => $this->warehouse_id,
                ]); */
            //}
       /*  $inventory->quantity_balance = $newQuantityBalance;
        $inventory->total_balance = $newTotalBalance;
        $inventory->cost_balance = $newTotalBalance / ($newQuantityBalance ?: 1);
        $inventory->save(); */

        if($this->type == 1){
            Kardex::registerEntry($movement, $product, $this->warehouse_id, 'Movimiento');

        }elseif($this->type == 2){
             Kardex::registerExit($movement, $product, $this->warehouse_id, 'Movimiento');
        }


        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'El movimiento se ha creado exitosamente'
        ]);

        return redirect()->route('admin.movements.index');
    }
    public function render()
    {
        return view('livewire.admin.movement-create');
    }
}
