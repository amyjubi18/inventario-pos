<?php

namespace App\Livewire\Admin;

use App\Facades\Kardex;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\ShoppingCart as ShoppingCartModel;
use App\Models\Warehouse;
use Livewire\Component;
use Illuminate\Support\Collection;

class ShoppingCart extends Component
{
    protected $listeners = [
        'saveCustomer' => 'saveCustomer',
        'confirmInvoice' => 'confirmInvoice',
    ];

    public $voucher_type = 1;
    public $serie = 'F001';
    public $correlative;
    public $date;
    public $quote_id;
    public $customer_id;
    public $total = 0;
    public $observation;
    public $product_id;
    public $products = [];
    public $availableProducts = [];
    public $customerData = [
        'identity_id' => '',
        'document_number' => '',
        'name' => '',
        'address' => '',
        'email' => '',
        'phone' => ''
    ];
    public $payment_method = 'efectivo';
    public $payment_type = 'contado';
    public $amount_paid = 0;
    public $change = 0;
    public $input_amount_paid = 0;
    public $customerKey = 0;
    public $warehouse_id;

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

    public function confirmInvoice($data){
        $this->amount_paid = (float) $data['amount_paid'];
        if($this->payment_type == 'contado'){
            $this->change = $this->amount_paid - $this->total;
        }
        $this->save();
    }

    public function updated($property, $value){
        if($property == 'quote_id'){
            $quote = \App\Models\Quote::find($value);

            if($quote){
                $this->voucher_type = $quote->voucher_type;
                $this->customer_id = $quote->customer_id;
                $this->products = $quote->products->map(function($product){
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->pivot->price,
                        'quantity' => $product->pivot->quantity,
                        'subtotal' => $product->pivot->subtotal,
                        'image' => $product->image,
                        'stock' => $product->stock
                    ];
                })->toArray();
            }
        }
        if($property == 'warehouse_id'){
            $this->loadAvailableProducts();
        }
    }

    public function mount(){
        $this->correlative = Sale::max('correlative') + 1;
        $this->loadAvailableProducts();
        $this->warehouse_id = Warehouse::first()->id ?? null; // Default to first warehouse

        // If coming back from customer creation, set the customer_id if provided
        if (request()->has('customer_id')) {
            $this->customer_id = request('customer_id');
        }
    }

    public function openCustomerModal(){
        session(['customer_create_referer' => url()->current()]);
        return redirect()->route('admin.customers.create');
    }

    public function saveCustomer($customerData){
        $this->customerData = $customerData;

        $this->validate([
            'customerData.identity_id' => 'required|exists:identities,id',
            'customerData.document_number' => 'required|string|max:20|unique:customers,document_number',
            'customerData.name' => 'required|string|max:255',
            'customerData.address' => 'nullable|string|max:255',
            'customerData.email' => 'nullable|email|max:255',
            'customerData.phone' => 'nullable|string|max:20',
        ], [], [
            'customerData.identity_id' => 'Tipo de documento',
            'customerData.document_number' => 'Número de documento',
            'customerData.name' => 'Nombre',
            'customerData.address' => 'Dirección',
            'customerData.email' => 'Correo',
            'customerData.phone' => 'Teléfono'
        ]);

        $customer = Customer::create($customerData);
        $this->customer_id = $customer->id;
        $this->reset('customerData');
        $this->customerKey++;

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cliente creado',
            'text' => 'El cliente se ha creado correctamente'
        ]);
    }

    public function loadAvailableProducts(){
        $this->availableProducts = Product::where('stock', '>', 0)
            ->when($this->warehouse_id, function($query) {
                return $query->whereHas('inventories', function($q) {
                    $q->where('warehouse_id', $this->warehouse_id)
                      ->where('quantity_balance', '>', 0);
                });
            })
            ->get()->map(function($product){
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'image' => $product->image
                ];
            })->toArray();
    }

    public function addProduct(){
        $this->validate([
            'product_id' => 'required|exists:products,id'
        ], [], [
            'product_id' => 'producto'
        ]);

        $existing = collect($this->products)->firstWhere('id', $this->product_id);

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
            'subtotal' => $product->price,
            'image' => $product->image,
            'stock' => $product->stock
        ];

        $this->calculateTotal();
        $this->reset('product_id');
    }

    public function processInvoice(){
        $this->validate([
            'products' => 'required|array|min:1',
            'customer_id' => 'required|exists:customers,id',
            'payment_method' => 'required|in:efectivo,tarjeta,cheque,transferencia',
        ]);

        $this->dispatch('swal',[
            'icon' => 'info',
            'title' => 'Confirmar Factura',
            'html' => '<div style="text-align: center; font-size: 28px; font-weight: bold; margin-bottom: 20px;">Total: S/ ' . number_format($this->total, 2) . '</div><label style="display: block; margin-bottom: 10px;">Monto a Pagar: <input type="number" id="amount_paid" step="0.01" min="' . $this->total . '" value="' . $this->total . '" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></label><div id="change_display" style="margin-top: 10px; font-weight: bold;"></div>',
            'showCancelButton' => true,
            'confirmButtonText' => 'Confirmar y Guardar',
            'cancelButtonText' => 'Cancelar'
        ]);
    }

    public function updatedAmountPaid(){
        if($this->payment_type == 'contado'){
            $this->change = (float) $this->amount_paid - $this->total;
        }
    }

    public function updatedInputAmountPaid(){
        if($this->payment_type == 'contado'){
            $this->change = (float) $this->input_amount_paid - $this->total;
        }
    }

    public function saveWithAmount(){
        if($this->payment_type == 'contado' && (float) $this->input_amount_paid >= $this->total){
            $this->change = (float) $this->input_amount_paid - $this->total;
            $this->amount_paid = (float) $this->input_amount_paid;
            $this->save();
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Monto Insuficiente',
                'text' => 'El monto pagado debe ser mayor o igual al total.'
            ]);
        }
    }

    public function updatedPaymentType(){
        if($this->payment_type == 'credito'){
            $this->amount_paid = 0;
            $this->change = 0;
        }
    }

    public function addProductById($productId){
        $this->product_id = $productId;
        $this->addProduct();
    }

    public function calculateTotal(){
        $this->total = collect($this->products)->sum(function($product){
            return $product['quantity'] * $product['price'] * 1.18;
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
            'payment_method' => 'required|in:efectivo,tarjeta,cheque,transferencia',
            'payment_type' => 'required|in:contado,credito',
            'amount_paid' => 'required_if:payment_type,contado|numeric|min:0',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ], [], [
            'voucher_type' => 'Tipo de comprobante',
            'customer_id' => 'Cliente',
            'warehouse_id' => 'Almacén',
            'observation' => 'Observaciones',
            'payment_method' => 'Forma de pago',
            'payment_type' => 'Tipo de pago',
            'amount_paid' => 'Monto a pagar',
            'products.*.id' => 'Producto',
            'products.*.quantity' => 'Cantidad',
            'products.*.price' => 'Precio'
        ]);

        if($this->payment_type == 'contado' && (float) $this->amount_paid < $this->total){
            $this->addError('amount_paid', 'El monto pagado debe ser mayor o igual al total.');
            return;
        }

        $sale = Sale::create([
            'voucher_type' => $this->voucher_type,
            'serie' => $this->serie,
            'correlative' => $this->correlative,
            'date' => $this->date ?? now(),
            'quote_id' => $this->quote_id,
            'customer_id' => $this->customer_id,
            'warehouse_id' => $this->warehouse_id,
            'total' => $this->total,
            'observation' => $this->observation,
            'payment_method' => $this->payment_method,
            'amount_paid' => $this->amount_paid,
            'change' => $this->change
        ]);

        foreach($this->products as $product){
            $sale->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['quantity'] * $product['price']
            ]);

            // Kardex handling
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

        // Guardar en la tabla shopping_carts (un solo registro con productos en JSON)
        ShoppingCartModel::create([
            'customer_id' => $this->customer_id,
            'products' => $this->products,
            'warehouse_id' => $this->warehouse_id,
            'total' => $this->total,
            'payment_method' => $this->payment_method,
            'amount_paid' => $this->amount_paid,
            'change' => $this->change,
            'quote_id' => $this->quote_id
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien Hecho',
            'text' => 'La venta se ha creado correctamente'
        ]);

        return redirect()->route('admin.shopping-carts.index');
    }

    public function render()
    {
        return view('livewire.admin.shopping-cart');
    }
}
