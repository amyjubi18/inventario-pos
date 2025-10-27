<div class="flex items-center space-x-2">
    @can('update-warehouses')
    <x-wire-button href="{{ route('admin.warehouses.edit', $warehouse) }}" green xs>
    <i class="fas fa-edit "> </i>Editar</x-wire-button>
    @endcan
    @can('delete-warehouses')
    <form action="{{ route('admin.warehouses.destroy', $warehouse) }}" method="post" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" red xs>
        <i class="fas fa-trash-alt"> </i>Eliminar
        </x-wire-button>
    </form>
    @endcan
</div>
