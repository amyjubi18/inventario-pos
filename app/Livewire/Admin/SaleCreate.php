<?php

namespace App\Livewire\Admin;

use App\Facades\Kardex;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\Sale;
use App\Services\KardexService;
use Livewire\Component;

class SaleCreate extends Component
{
    public $voucher_type = 1;
    public $serie = 'F001';
    public $correlative;
    public $date;
    public $quote_id;
    public $customer_id;

    public $warehouse_id;
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

    public function updated($property, $value){
        if($property == 'quote_id'){
            $quote = Quote::find($value);

            if($quote){
                $this->voucher_type = $quote->voucher_type;
                $this->customer_id = $quote->customer_id;


                $this->products = $quote->products->map(function($product){
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->pivot->price,
                        'quantity' => $product->pivot->quantity,
                        'subtotal' => $product->pivot->subtotal
                    ];
                })->toArray();
            }

        }
    }

    public function mount(){
        $this->correlative =Quote::max('correlative') + 1;
    }
    public function addProduct(){
        $this->validate([
            'product_id' => 'required|exists:products,id'
        ],[],[
            'product_id' => 'producto'
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
        $this->products[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'subtotal' => $product->price
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
            'voucher_type' => 'required|in:1,2',
            'serie' => 'required|string|max:10',
            'correlative' => 'required|numeric|min:1',
            'date' => 'nullable|date',
            'quote_id' => 'nullable|exists:quotes,id',
            'customer_id' => 'required|exists:customers,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'total' => 'required|numeric|min:0',
            'observation' => 'nullable|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ],[],[
            'voucher_type' => 'Tipo de comprobante',
            'customer_id' => 'Cliente',
            'observation' => 'Observaciones',
            'products.*.id' => 'Producto',
            'products.*.quantity' => 'Cantidad',
            'products.*.price' => 'Precio'
        ]);

        $sale = Sale::create([
            'voucher_type' => $this->voucher_type,
            'serie' => $this->serie,
            'correlative' => $this->correlative,
            'date' => $this->date ?? now(),
            'quote_id' => $this->quote_id,
            'customer_id' => $this->customer_id,
            'warehouse_id' => $this->warehouse_id,
            'total' => $this->total,
            'observation' => $this->observation
        ]);

        foreach($this->products as $product){
            $sale->products()->attach($product['id'], [
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
            $lastCostBalance = $lastRecord?->cost_balance ?? 0;



            $newQuantityBalance = $lastQuantityBalance - $product['quantity'];
            $newTotalBalance = $lastTotalBalance - ($product['quantity'] * $lastCostBalance);
            $newCostBalance = $newTotalBalance / ($newQuantityBalance ?: 1);

            $sale->inventories()->create([
                'detail' => 'Venta',
                'quantity_out' => $product['quantity'],
                'cost_out' => $lastCostBalance,
                'total_out' => $product['quantity'] * $lastCostBalance,
                'quantity_balance' => $newQuantityBalance,
                'total_balance' => $newTotalBalance,
                'cost_balance' => $newCostBalance,
                'product_id' => $product['id'],
                'warehouse_id' => $this->warehouse_id,
            ]); */
            $result = Kardex::registerExit($sale, $product, $this->warehouse_id, 'Venta');
            if (!$result) {
                $lastRecord = Kardex::getLastRecord($product['id'], $this->warehouse_id);
                $this->dispatch('swal', [
                    'icon' => 'error',
                    'title' => 'Stock insuficiente',
                    'text' => "No hay suficiente stock disponible para el producto ID {$product['id']}. Stock actual: {$lastRecord['quantity']}, solicitado: {$product['quantity']}."
                ]);
                return;
            }
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'La venta se ha creado correctamente'
        ]);

        return redirect()->route('admin.sales.index');
    }
    public function render()
    {
        return view('livewire.admin.sale-create');
    }
}
