<x-admin-layout
title="Reportes | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Clientes mas frecuentes',

    ],
]"
>
@livewire('admin.datatables.top-customers-table')
</x-admin-layout>
