<x-admin-layout
title="Productos | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Productos',
        'href' => route('admin.products.index')

    ],
    [
        'name' => 'Importación',
    ]
]"
>
@livewire('admin.import-of-products')
</x-admin-layout>
