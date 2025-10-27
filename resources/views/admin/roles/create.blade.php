<x-admin-layout
title="Roles | Inventario POS"
:breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard')
    ],
    [
        'name' => 'Roles',
        'href' => route('admin.roles.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]"
>
<x-wire-card class="dark:bg-gray-700 dark:text-white">
    <h1 class="mb-4 text-2xl font-semibold">Nuevo Rol</h1>
    <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-4">
            @csrf
            <x-wire-input
                label="Nombre del Rol"
                name="name"
                placeholder="Ejm: Admin"
                required
                value="{{ old('name') }}"
            />
        <div>
            <p class="block mb-2 text-sm font-medium text-gray-600 disabled:opacity-60 dark:text-gray-300">
                Permisos
            </p>
            <ul class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($permissions as $permission )
                <li>

                    <label>
<x-checkbox
name="permissions[]"
value="{{ $permission->id }}"
:checked="in_array($permission->id, old('permissions', []))"
/>
                    </label>
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $permission->name }}</span>
                </li>

                @endforeach
            </ul>
        </div>
        <div class="flex justify-end">
            <x-wire-button blue type="submit" blue>
                Crear Rol
            </x-wire-button>
        </div>
    </form>
</x-wire-card>
</x-admin-layout>
