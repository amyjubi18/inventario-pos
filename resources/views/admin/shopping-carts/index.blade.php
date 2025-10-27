<x-admin-layout
title="Carritos de Compras | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Carritos de Compras'
    ]
]"
>
@can('create-sales')
<x-slot name="action">
    <x-wire-button href="{{ route('admin.shopping-carts.create') }}" blue>
       <i class="fas fa-plus "></i> Nuevo
    </x-wire-button>
</x-slot>
@endcan
@livewire('admin.datatables.shopping-cart-table')

</x-admin-layout>
