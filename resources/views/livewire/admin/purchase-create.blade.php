<div x-data="{
    products: @entangle('products'),

    total: @entangle('total'),


    removeProduct(index) {
        this.products.splice(index, 1);
        $wire.set('products', this.products);
    },

    init(){
        this.$watch('products', (newProducts) => {
            let total = 0;
            newProducts.forEach(product => {
                total += product.quantity * product.price;
            });
            this.total = total;

            });

        }
    }">
    <x-wire-card class="dark:bg-gray-700">
        <form wire:submit="save" class="space-y-4">
            <div class="grid gap-4 lg:grid-cols-4">

                <x-wire-native-select
                label="Tipo de comprobante"
                wire:model="voucher_type">
                    <option value="1">Factura</option>
                    <option value="2">Boleta</option>
                </x-wire-native-select>
            <div class="grid grid-cols-2 gap-2">
                <x-wire-input
                label="Serie"
                wire:model="serie"
                placeholder="Serie del comprobante"

                />

                <x-wire-input
                class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                label="Correlativo"
                wire:model="correlative"
                placeholder="Correlativo del comprobante"

                />
            </div>
                <x-wire-input
                class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                label="Fecha"
                wire:model="date"
                type="date"
                />
                <x-wire-select
                label="Orden de Compra"
                wire:model.live="purchase_order_id"
                placeholder="Seleccione una orden de compra"
                :async-data="[
                    'api' => route('api.purchase_orders.index'),
                    'method' => 'POST'
                    ]"
                option-label="name"
                option-value="id"
                option-description="description"
            />
                <div class="col-span-2">
                    <x-wire-select
                    label="Proveedor"
                    wire:model="supplier_id"
                    placeholder="Seleccione un proveedor"
                    :async-data="[
                        'api' => route('api.suppliers.index'),
                        'method' => 'POST'
                        ]"
                    option-label="name"
                    option-value="id"
                />
                </div>

                <div class="col-span-2">
                    <x-wire-select
                    label="Almacenes"
                    wire:model="warehouse_id"
                    placeholder="Seleccione un Almacen"
                    :async-data="[
                        'api' => route('api.warehouses.index'),
                        'method' => 'POST'
                        ]"
                    option-label="name"
                    option-value="id"
                    option-description="description"
                     :disabled="count($products)"
                />
                </div>
            </div>





            <div class=" lg:space-x-4 lg:flex">
                <x-wire-select
                label="Producto"
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
            <div class="flex-shrink-0">
                <x-wire-button wire:click='addProduct' blue style="margin-top: 25px;" class="w-full mt-6.5" spinner="addProduct">
                Agregar Producto
                </x-wire-button>
            </div>

            </div>
            <div class="w-full overflow-x-auto">
                 <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-600 dark:text-gray-400">
                    <tr class="text-gray-700 border-y bg-blue-50 dark:bg-gray-800 dark:text-white">
                        <th scope="col" class="px-6 py-3">
                            Producto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio
                        </th>
                        <th scope="col" class="px-6 py-3">
                           SubTotal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(product, index) in products" :key="product.id">
                         <tr class="border-b">
                        <td class="px-6 py-4" x-text="product.name">
                        </td>
                        <td class="px-6 py-4">
                            <x-wire-input
                            x-model="product.quantity"
                            type="number"
                            class="w-20"
                            />
                        </td>
                        <td class="px-6 py-4">
                            <x-wire-input
                            x-model="product.price"
                            type="number"
                            class="w-20"
                            step="0.01"
                            />
                        </td>
                        <td class="px-6 py-4" x-text="(product.quantity * product.price).toFixed(2)">
                        </td>
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
                            <td colspan="5" class="py-4 text-center text-gray-500 dark:text-white">
                            No hay productos agregados
                            </td>
                        </tr>


                    </template>

                </tbody>


            </table>
            </div>


                <div class="flex items-center space-x-4">
                    <x-label class="dark:text-white">
                        Observaciones
                    </x-label>
                    <x-wire-input
                    class="flex-1"
                    wire:model="observation"
                    />

                        <div class="dark:text-white dark:font-semibold">
                            Total: S/ . <span x-text="total.toFixed(2)"></span>
                        </div>
            </div>
            <div class="flex justify-end">
                <x-wire-button blue type="submit" icon="check" spinner="save">
                    Guardar
                </x-wire-button>
            </div>


        </form>
    </x-wire-card>
</div>
