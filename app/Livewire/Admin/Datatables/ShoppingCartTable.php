<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\ShoppingCart;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Facades\Mail;
use App\Mail\PdfSend;

class ShoppingCartTable extends DataTableComponent
{
    protected $model = ShoppingCart::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
        $this->setAdditionalSelects(['shopping_carts.id']);
        $this->setPerPage(10);
        $this->setConfigurableAreas([
            'after-wrapper' => [
                'pdf.modal'
            ]
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Cliente", "customer.name")
                ->sortable()
                ->searchable(),

            Column::make("Productos", "products")
                ->format(function($value) {
                    if (is_array($value)) {
                        $productNames = array_map(function($product) {
                            return $product['name'] ?? 'N/A';
                        }, $value);
                        return implode(', ', $productNames);
                    }
                    return 'N/A';
                }),

            Column::make("Total", "total")
                ->sortable()
                ->format(fn($value)=> 'S/ '. number_format($value, 2,'.',',')),

            Column::make("Forma de Pago", "payment_method")
                ->sortable()
                ->format(function($value) {
                    $methods = [
                        'efectivo' => 'Efectivo',
                        'tarjeta' => 'Tarjeta',
                        'cheque' => 'Cheque',
                        'transferencia' => 'Transferencia'
                    ];
                    return $methods[$value] ?? $value;
                }),

            Column::make("Monto Pagado", "amount_paid")
                ->sortable()
                ->format(fn($value)=> $value ? 'S/ '. number_format($value, 2,'.',',') : '-'),

            Column::make("Monto de Cambio", "change")
                ->sortable()
                ->format(fn($value)=> $value ? 'S/ '. number_format($value, 2,'.',',') : '-'),

          

            Column::make('Acciones')
                ->label(function($row){
                    return view('admin.shopping-carts.actions', [
                        'shoppingCart' => $row,
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return ShoppingCart::query()->with(['customer', 'warehouse']);
    }

    // propiedades
    public $form =[
        'open' => false,
        'email' => '',
        'document' => '',
        'client' => '',
        'model' => null,
        'view_pdf_patch' => 'admin.shopping-carts.pdf',
    ];

    //metodo
    public function openModal(ShoppingCart $shoppingCart){
        $this->form['email'] = $shoppingCart->customer->email;
        $this->form['open'] = true;
        $this->form['document'] = 'Carrito de Compras '. $shoppingCart->id;
        $this->form['client'] = $shoppingCart->customer->document_number . ' - ' . $shoppingCart->customer->name;
        $this->form['model'] = $shoppingCart;
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
