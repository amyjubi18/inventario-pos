<x-admin-layout
title="Clientes | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Clientes',
        'href' => route('admin.customers.index')

    ],
    [
        'name' => 'Nuevo'
    ]
]">

<x-wire-card class="dark:bg-gray-700">
    <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <x-wire-native-select
            label='Tipo de documento'
            name='identity_id'

            >
                @foreach ($identities as $identity )
                <option value="{{ $identity->id }}" @selected(old('identity_id') == $identity->id)>
                    {{ $identity->name }}
                </option>
                @endforeach
            </x-wire-native-select>
            <x-wire-input
            class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            label="Numero de documento"
            name="document_number"
            placeholder="Numero de documento"
            value="{{ old('document_number') }}"
            required
            />
        </div>

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Nombre" name="name"  placeholder="Nombre del Cliente"  value="{{ old('name') }}" />

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Direccion" name="address"  placeholder="Direccion del Cliente"  value="{{ old('address') }}" />

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Correo" name="email" type="email" placeholder="Correo electronico del Cliente"  value="{{ old('email') }}" />

        <x-wire-input class="dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" label="Telefono" name="phone"  placeholder="Telefono del Cliente"  value="{{ old('phone') }}" />

        <div class="flex justify-end">
            <x-button class="dark:bg-black dark:hover:bg-gray-800" >
                Guardar
            </x-button>
        </div>


    </form>
</x-wire-card>

</x-admin-layout>
