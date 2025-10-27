<div class="flex items-center space-x-2">
    @can('update-users')
    <x-wire-button href="{{ route('admin.users.edit', $user) }}" green xs>
    <i class="fas fa-edit "> </i>Editar</x-wire-button>
    @endcan
    @can('delete-users')
    <form action="{{ route('admin.users.destroy', $user) }}" method="post" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" red xs>
        <i class="fas fa-trash-alt"> </i>Eliminar
        </x-wire-button>
    </form>
    @endcan
</div>
