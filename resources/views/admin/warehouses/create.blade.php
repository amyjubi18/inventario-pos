<x-admin-layout
title="Almacenes | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Almacenes',
        'href' => route('admin.warehouses.index')

    ],
    [
        'name' => 'Nuevo'
    ]
]">

<x-wire-card class="dark:bg-gray-700">
    <form action="{{ route('admin.warehouses.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Nombre" name="name"  placeholder="Nombre del Almacen"  value="{{ old('name') }}" />

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Ubicacion" name="location"  placeholder="Ubicacion del Almacen"  value="{{ old('location') }}" />

        <div class="flex justify-end">
            <x-button class="dark:bg-black dark:hover:bg-gray-800" >
                Guardar
            </x-button>
        </div>


    </form>
</x-wire-card>

</x-admin-layout>
