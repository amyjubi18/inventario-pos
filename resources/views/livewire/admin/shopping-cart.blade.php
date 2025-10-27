<div class="grid grid-cols-2 gap-4" x-data="{
    products: @entangle('products'),
    availableProducts: @entangle('availableProducts'),

    total: @entangle('total'),


    removeProduct(index) {
        this.products.splice(index, 1);
        $wire.set('products', this.products);
    },

    init(){
        this.$watch('products', (newProducts) => {
            let total = 0;
            newProducts.forEach(product => {
                total += product.quantity * product.price * 1.18;
            });
            this.total = total;

            });

        }
    }">


    <x-wire-card class="dark:bg-gray-700">
        <form wire:submit="processInvoice" class="space-y-4" wire:loading.attr="disabled" wire:target="processInvoice, addProduct">
            <div wire:loading wire:target="processInvoice, addProduct" class="mb-2 font-semibold text-center text-blue-600">
                Procesando...
            </div>






            <div class=" lg:block">
                <x-wire-select
                label="Buscar Producto"
                wire:model="product_id"
                placeholder="Seleccione un producto"
                :async-data="[
                    'api' => route('api.products.index'),
                    'method' => 'POST'
                    ]"
                option-label="name"
                option-value="id"
                class="flex-1 active:dark:text-white:"
            />
            <div class="">
                <x-wire-button wire:click='addProduct' blue  class="w-full mt-4" spinner="addProduct">
                Agregar Producto
                </x-wire-button>
            </div>


            </div>

            <!-- Available Products Section -->
            <div class="mt-4">
                <h3 class="mb-2 text-lg font-semibold dark:text-white">Productos Disponibles</h3>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2">
                    <template x-for="product in availableProducts" :key="product.id">
                        <div class="p-4 bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-600">
                            <img :src="product.image" :alt="product.name" class="object-cover w-full h-32 mb-2 rounded">
                            <h4 class="text-sm font-semibold dark:text-white" x-text="product.name"></h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Precio: S/ <span x-text="product.price"></span></p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Stock: <span x-text="product.stock"></span></p>
                            <button @click="$wire.addProductById(product.id)" class="w-full px-2 py-2 mt-2 text-xs font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                Agregar al carrito
                            </button>
                        </div>
                    </template>
                </div>
            </div>







    </x-wire-card>



   <x-wire-card class="dark:bg-gray-700">

            <div class="col-span-2">
                    <x-wire-select
                    class="dark:active:text-white"
                    label="Seleccione el Cliente"
                    wire:model="customer_id"
                    wire:key="customer-{{ $customerKey }}"
                    placeholder="Seleccione un cliente"
                    :async-data="[
                        'api' => route('api.customers.index'),
                        'method' => 'POST'
                        ]"
                    option-label="name"
                    option-value="id"
                />


                <div class="flex justify-end mt-2">
                    <x-wire-button wire:click="openCustomerModal" blue>
                        <i class="fas fa-plus"></i> Registrar Cliente
                    </x-wire-button>
                </div>
                </div>

                <div class="col-span-2" style="display: none">
                    <x-wire-select
                    class="dark:active:text-white"
                    label="Seleccione el Almacén"
                    wire:model="warehouse_id"
                    placeholder="Seleccione un almacén"
                    :async-data="[
                        'api' => route('api.warehouses.index'),
                        'method' => 'POST'
                        ]"
                    option-label="name"
                    option-value="id"
                />
                </div>



            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-400">
                        <tr class="text-gray-700 border-y bg-blue-50 dark:bg-gray-800 dark:text-white">
                            <th scope="col" class="px-6 py-3">Imagen</th>
                            <th scope="col" class="px-6 py-3">Producto</th>
                            <th scope="col" class="px-6 py-3">Cantidad</th>
                            <th scope="col" class="px-6 py-3">Precio</th>
                            <th scope="col" class="px-6 py-3">ITBIS</th>
                            <th scope="col" class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(product, index) in products" :key="product.id">
                            <tr class="border-b">
                                <td class="px-6 py-4">
                                    <img :src="product.image" :alt="product.name" class="object-cover w-16 h-16 rounded">
                                </td>
                                <td class="px-6 py-4" x-text="product.name"></td>
                                <td class="px-6 py-4">
                                    <x-wire-input
                                        x-model="product.quantity"
                                        type="number"
                                        class="w-20"
                                        min="1"
                                    />
                                </td>
                                <td class="px-6 py-4">
                                    <x-wire-input
                                        x-model="product.price"
                                        type="number"
                                        class="w-28"
                                        step="0.01"
                                        min="0"
                                    />
                                </td>
                                <td class="px-6 py-4" x-text="((product.quantity * product.price * 0.18).toFixed(2))"></td>
                                <td class="px-6 py-4">
                                    <x-wire-mini-button
                                        rounded
                                        x-on:click="removeProduct(index)"
                                        icon="trash"
                                        red
                                    />
                                </td>
                            </tr>
                        </template>
                        <template x-if="products.length === 0">
                            <tr>
                                <td colspan="8" class="py-4 text-center text-gray-500 dark:text-white">
                                    No hay productos agregados
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>


                <div class="flex items-center px-4 my-4 space-x-4">
                    <x-wire-native-select
                    label="Forma de Pago"
                    wire:model="payment_method">
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="cheque">Cheque</option>
                        <option value="transferencia">Transferencia</option>
                    </x-wire-native-select>


            </div>
            <div class="mx-4 text-xl font-bold dark:text-white dark:font-semibold">
                            Total: S/ . <span x-text="total.toFixed(2)"></span>
                        </div>
            @if(count($products) > 0)
            <div class="flex justify-center mt-4 ml-4 mr-4 space-x-4">
                <div class="flex-1">
                    <x-wire-input
                        label="Monto a Pagar"
                        wire:model.live="input_amount_paid"
                        type="number"
                        step="0.01"
                        min="{{ $total }}"
                        placeholder="Ingrese monto pagado"
                    />
                    @if($change > 0)
                        <p class="mt-2 text-xl font-semibold text-green-600">Vuelto: S/ {{ number_format($change, 2) }}</p>
                    @endif
                </div>



            </div>
            <div class="mx-2 mt-4">
             <x-wire-button class="w-full" wire:click="saveWithAmount" blue icon="check" spinner="saveWithAmount">
                        Procesar Factura
                    </x-wire-button>
            </div>
            @endif



        </form>
    </x-wire-card>


</div>
