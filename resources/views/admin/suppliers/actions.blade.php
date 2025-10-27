<div class="flex items-center space-x-2">
    @can('update-suppliers')

    <x-wire-button href="{{ route('admin.suppliers.edit', $supplier) }}" green xs>
    <i class="fas fa-edit "> </i>Editar</x-wire-button>
        @endcan
    @can('delete-suppliers')
    <form action="{{ route('admin.suppliers.destroy', $supplier) }}" method="post" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" red xs>
        <i class="fas fa-trash-alt"> </i>Eliminar
        </x-wire-button>
    </form>
    @endcan
</div>
