<div class="flex items-center space-x-2">
    @can('update-roles')
    <x-wire-button href="{{ route('admin.roles.edit', $role) }}" green xs>
    <i class="fas fa-edit "> </i>Editar</x-wire-button>
    @endcan
    @can('delete-roles')
    <form action="{{ route('admin.roles.destroy', $role) }}" method="post" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" red xs>
        <i class="fas fa-trash-alt"> </i>Eliminar
        </x-wire-button>
    </form>
    @endcan
</div>
