
<x-modal-card title="Stock por Almacen" wire:model="openModal">
    <ul class="space-y-3">
        @forelse ($inventories as $inventory )
            <li class="flex items-center justify-between p-4 mb-2 bg-gray-100 rounded-lg shadow-sm">
                <div >
                    <p class="text-sm text-gray-600">
                        {{ $inventory->warehouse->name }}:
                    </p>
                    <p class="font-medium text-gray-800">
                        {{ $inventory->warehouse->location }}

                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">
                        Stock Disponible
                    </p>
                    <p class="text-lg font-bold {{ $inventory->quantity_balance > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $inventory->quantity_balance }}
                    </p>

                </div>
            </li>
        @empty
            <li class="py-10 text-center text-gray-500">
                No hay inventarios disponibles.
            </li>
        @endforelse
    </ul>
</x-modal-card>
