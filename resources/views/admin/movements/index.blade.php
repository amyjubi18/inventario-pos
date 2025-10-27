<x-admin-layout
title="Entradas y Salidas | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Entradas y Salidas',

    ],
]"
>
 @can('create-movements')
<x-slot name="action">

    <x-wire-button href="{{ route('admin.movements.create') }}" blue>
       <i class="fas fa-plus "></i> Nuevo
    </x-wire-button>

</x-slot>
@endcan
@livewire('admin.datatables.movement-table')

</x-admin-layout>
