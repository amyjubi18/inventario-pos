<x-admin-layout
title="Provedores | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Provedores',
        'href' => route('admin.suppliers.index')

    ],
    [
        'name' => 'Editar'
    ]
]">
<x-wire-card class="dark:bg-gray-700">
    <form action="{{ route('admin.suppliers.update', $supplier) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <x-wire-native-select
            label='Tipo de documento'
            name='identity_id'

            >
                @foreach ($identities as $identity )
                <option value="{{ $identity->id }}" @selected(old('identity_id', $supplier->identity_id) == $identity->id)>
                    {{ $identity->name }}
                </option>
                @endforeach
            </x-wire-native-select>
            <x-wire-input
            class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            label="Numero de documento"
            name="document_number"
            placeholder="Numero de documento"
            value="{{ old('document_number', $supplier->document_number) }}"
            required
            />
        </div>

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Nombre" name="name"  placeholder="Nombre del Proveedor"  value="{{ old('name', $supplier->name) }}" />

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Direccion" name="address"  placeholder="Direccion del Proveedor"  value="{{ old('address', $supplier->address) }}" />

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Correo" name="email" type="email" placeholder="Correo electronico del Proveedor"  value="{{ old('email', $supplier->email) }}" />

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Telefono" name="phone"  placeholder="Telefono del Proveedor"  value="{{ old('phone', $supplier->phone) }}" />

        <div class="flex justify-end">
            <x-button class="dark:bg-black dark:hover:bg-gray-800" >
                Actualizar
            </x-button>
        </div>


    </form>
</x-wire-card>

</x-admin-layout>
