<x-admin-layout
title="Provedores | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Provedores',

    ],
]"
>

@push('css')
<style>
    table th span, table td {
        font-size: 0.75rem !important;
    }
</style>

@endpush

@can('create-suppliers')


<x-slot name="action">
    <x-wire-button href="{{ route('admin.suppliers.create') }}" blue>
       <i class="fas fa-plus "></i> Nuevo
    </x-wire-button>
</x-slot>
@endcan
@livewire('admin.datatables.supplier-table')


</x-admin-layout>
