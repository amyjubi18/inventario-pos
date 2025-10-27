<div>
    <x-wire-alert title="Producto Seleccionado" info  class="mb-6 text-blue-900 bg-blue-50">
    <x-slot name="slot" class="italic text-blue-900">
        <p class="text-blue-900">
            <span class="font-bold text-blue-900">Nombre:</span>
            {{ $product->name }}
        </p>
        <p class="text-blue-900">
            <span class="font-bold text-blue-900">SKU:</span>
            {{ $product->sku ?? 'No definido' }}
        </p>
        <p>
            <span class="font-bold text-blue-900">Stock Total:</span>
            {{ $product->stock }}
        </p>
    </x-slot>
    </x-wire-alert>

   <x-wire-card class="mb-6">
    <div class="grid grid-cols-2 gap-4">
        <x-wire-input label="Fecha Inicial" type="date" wire:model.live="fecha_inicial"/>
        <x-wire-input label="Fecha Final" type="date" wire:model.live="fecha_final"/>

        <x-wire-select
        class="col-span-2 0"
        label="Almacen"
        wire:model.live="warehouse_id"
        :options="$warehouses->select('id', 'name')"
        option-label="name"
        option-value="id"
        option-class="bg-blue-400"

        />
    </div>
   </x-wire-card>


   <h2 class="mb-4 text-lg font-semibold text-gray-800">
    Kardex de Productos
   </h2>
   @if ($inventories->count())


   <div class="mb-4 overflow-x-auto border border-gray-200 shadow-sm rounded-xl">
    <table class="min-w-full text-sm text-gray-700 bg-white">
        <thead>
            <tr>
                <th  class="px-4 py-2 text-left text-gray-700 bg-gray-100" rowspan="2">
                    Detalle
                </th>
                <th class="px-4 py-2 text-center text-green-800 bg-green-100" colspan="3">
                    Entradas
                </th>
                <th class="px-4 py-2 text-center text-red-800 bg-red-100" colspan="3">
                    Salidas
                </th>
                <th class="px-4 py-2 text-center text-blue-800 bg-blue-100" colspan="3">
                    Balance
                </th>
                <th  class="px-4 py-2 text-left text-gray-700 bg-gray-100" rowspan="2">
                    Fecha
                </th>
            </tr>
            <tr class="text-gray-700">

                <th scope="col" class="px-2 py-1 text-center bg-green-50">
                    Cant.
                </th>
                <th scope="col" class="px-2 py-1 text-center bg-green-50">
                    Costo
                </th>
                <th scope="col" class="px-2 py-1 text-center bg-green-50">
                    Total
                </th>
                <th scope="col" class="px-2 py-1 text-center bg-red-50">
                    Cant.
                </th>
                <th scope="col" class="px-2 py-1 text-center bg-red-50">
                    Costo
                </th>
                <th scope="col" class="px-2 py-1 text-center bg-red-50">
                    Total
                </th>
                <th scope="col" class="px-2 py-1 text-center bg-blue-50">
                    Cant.
                </th>
                <th scope="col" class="px-2 py-1 text-center bg-blue-50">
                    Costo
                </th>
                <th scope="col" class="px-2 py-1 text-center bg-blue-50">
                    Total
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($inventories as $inventory )
                <tr>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->detail }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->quantity_in }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->cost_in }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->total_in }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->quantity_out }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->cost_out }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->total_out }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->quantity_balance }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->cost_balance }}

                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->total_balance }}
                   </td>
                   <td class="px-4 py-2 text-center">
                    {{ $inventory->created_at->format('Y-m-d') }}
                   </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="px-6 py-4 text-center whitespace-nowrap">
                        No hay registros.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
   </div>
    <div class="mt-4">
     {{ $inventories->links() }}
    </div>
    @else
    <x-wire-card class="flex flex-col items-center">
        <p class="text-lg font-semibold text-center text-gray-800">No hay registros de inventario</p>
        <p class="text-sm text-center text-gray-500">Todavia no se han registrado entradas o salidas de Productos</p>
    </x-wire-card>
    @endif
</div>
