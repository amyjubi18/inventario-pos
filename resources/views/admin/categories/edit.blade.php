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
        'name' => 'Editar'
    ]
]">
<x-wire-card class="dark:bg-gray-700">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Nombre" name="name"  placeholder="Nombre de la categoria"  value="{{ old('name', $category->name) }}" />

        <x-wire-textarea class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Descripcion" name="description"  placeholder="Descripcion de la categoria" >
            {{ old('description', $category->description) }}
        </x-wire-textarea>
        <div class="flex justify-end">
            <x-button class="dark:bg-black dark:hover:bg-gray-800" >
                Actualizar
            </x-button>
        </div>


    </form>
</x-wire-card>

</x-admin-layout>
