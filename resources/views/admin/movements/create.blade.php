<x-admin-layout
title="Entradas y Salidas | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Entradas y Salidas',
        'href' => route('admin.movements.index')

    ],
    [
        'name' => 'Nuevo'
    ]

]"
>

@livewire('admin.movement-create')

</x-admin-layout>
