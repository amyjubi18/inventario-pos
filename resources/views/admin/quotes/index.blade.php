<x-admin-layout
title="Cotizaciones | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Cotizaciones',

    ],
]"
>
@can('create-quotes')
<x-slot name="action">

    <x-wire-button href="{{ route('admin.quotes.create') }}" blue>
       <i class="fas fa-plus "></i> Nuevo
    </x-wire-button>

</x-slot>
@endcan
@livewire('admin.datatables.quote-table')

</x-admin-layout>
