<x-admin-layout
title="Compras | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Compras',

    ],
]"
>
@can('create-purchases')
<x-slot name="action">

    <x-wire-button href="{{ route('admin.purchases.create') }}" blue>
       <i class="fas fa-plus "></i> Nuevo
    </x-wire-button>

</x-slot>
@endcan
@livewire('admin.datatables.purchase-table')

</x-admin-layout>
