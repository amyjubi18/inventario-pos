<x-admin-layout
title="Categorias | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Categorias',
        'href' => route('admin.categories.index')

    ],
    [
        'name' => 'Importar'
    ]
]">
@livewire('admin.import-of-categories')
</x-admin-layout>
