<x-admin-layout
title="Usuarios | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Usuarios',
        'href' => route('admin.users.index')


    ],
    [
        'name' => 'Editar'
    ]
]"
>
<x-wire-card class="dark:bg-gray-700 dark:text-white">
        <h1 class="mb-4 text-2xl font-semibold">Editar Usuario</h1>
        <form action="{{ route('admin.users.update', $user) }}" method="POST" >
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
            <x-wire-input
                label="Nombre"
                name="name"
                placeholder="Nombre del usuario"
                required
                value="{{ old('name', $user->name) }}"
            />
            <x-wire-input
                label="Correo Electronico"
                name="email"
                type="email"
                placeholder="Correo electronico del usuario"
                required
                value="{{ old('email', $user->email) }}"
            />
            <x-wire-input
            label="Contraseña"
            name="password"
            type="password"
            placeholder="Contraseña del usuario"

            />
            <x-wire-input
            label="Confirmar Contraseña"
            name="password_confirmation"
            type="password"
            placeholder="Confirmar contraseña del usuario"

            />
            <x-wire-native-select label="Rol" name="role" required>
                <option value="">Seleccione un rol</option>
                @foreach ($roles as $role)
                <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()->name ?? '') == $role->name)>{{ $role->name }}</option>
                @endforeach
            </x-wire-native-select>

        </div>

        <div class="flex justify-end mt-4">
            <x-wire-button class="dark:bg-black dark:hover:bg-gray-800"
            type="submit" blue
            >
                Actualizar Usuario
            </x-wire-button>
        </div>
        </form>

    </x-wire-card>
</x-admin-layout>
