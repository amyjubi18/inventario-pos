<x-admin-layout
title="Transferencias | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Transferencias',

    ],
]"
>
@can('create-transfers')
<x-slot name="action">

    <x-wire-button href="{{ route('admin.transfers.create') }}" blue>
       <i class="fas fa-plus "></i> Nuevo
    </x-wire-button>

</x-slot>
@endcan
@livewire('admin.datatables.transfer-table')

</x-admin-layout>
