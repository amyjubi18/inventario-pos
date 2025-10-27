<x-admin-layout
title="Carrito de Compras | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Carritos de Compras',
        'href' => route('admin.shopping-carts.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]"
>



@livewire('admin.shopping-cart')

</x-admin-layout>
