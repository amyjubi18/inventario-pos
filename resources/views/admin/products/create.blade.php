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
        'name' => 'Nuevo'
    ]
]">

<x-wire-card class="dark:bg-gray-700">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Nombre" name="name"  placeholder="Nombre de la categoria"  value="{{ old('name') }}" />

        <x-wire-textarea class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Descripcion" name="description"  placeholder="Descripcion de la categoria" value="{{ old('description') }}">
            {{ old('description') }}
        </x-wire-textarea>

         <x-wire-input type='number' class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Precio" name="price"  placeholder="Precio del Producto"  value="{{ old('price') }}" />

        <x-wire-native-select label="Categoria" name="category_id">
            @foreach ($categories as $category )
            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </x-wire-native-select>
        <div class="flex justify-end">
            <x-button class="dark:bg-black dark:hover:bg-gray-800" >
                Guardar
            </x-button>
        </div>


    </form>
</x-wire-card>

</x-admin-layout>
