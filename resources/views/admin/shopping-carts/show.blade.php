<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Detalle del Carrito de Compras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Información General</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <strong>ID:</strong> {{ $shoppingCart->id }}
                            </div>
                            <div>
                                <strong>Cliente:</strong> {{ $shoppingCart->customer->name }}
                            </div>
                            <div>
                                <strong>Total:</strong> S/ {{ number_format($shoppingCart->total, 2) }}
                            </div>
                            <div>
                                <strong>Forma de Pago:</strong>
                                @php
                                    $methods = [
                                        'efectivo' => 'Efectivo',
                                        'tarjeta' => 'Tarjeta',
                                        'cheque' => 'Cheque',
                                        'transferencia' => 'Transferencia'
                                    ];
                                @endphp
                                {{ $methods[$shoppingCart->payment_method] ?? $shoppingCart->payment_method }}
                            </div>
                            <div>
                                <strong>Monto Pagado:</strong> S/ {{ number_format($shoppingCart->amount_paid, 2) }}
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Productos</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Producto</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Cantidad</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-300">Precio</th>
                                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach($shoppingCart->products ?? [] as $product)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">{{ $product['name'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">{{ $product['quantity'] }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">S/ {{ number_format($product['price'], 2) }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">S/ {{ number_format($product['quantity'] * $product['price'], 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($shoppingCart->observation)
                    <div class="mb-6">
                        <h3 class="mb-4 text-lg font-semibold">Observaciones</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $shoppingCart->observation }}</p>
                    </div>
                    @endif

                    <div class="flex justify-end">
                        <a href="{{ route('admin.shopping-carts.index') }}" class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
