<x-admin-layout
title="Ordenes de Compra | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Ordenes de Compra',

    ],
]"
>
@can('create-purchase_orders')
<x-slot name="action">

    <x-wire-button href="{{ route('admin.purchase_orders.create') }}" blue>
       <i class="fas fa-plus "></i> Nuevo
    </x-wire-button>

</x-slot>
 @endcan
@livewire('admin.datatables.purchase-order-table')

</x-admin-layout>
