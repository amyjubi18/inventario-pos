<div class="flex items-center space-x-2">
    @can('update-customers')
    <x-wire-button href="{{ route('admin.customers.edit', $customer) }}" green xs>
    <i class="fas fa-edit "> </i>Editar</x-wire-button>
    @endcan
    @can('delete-customers')
    <form action="{{ route('admin.customers.destroy', $customer) }}" method="post" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" red xs>
        <i class="fas fa-trash-alt"> </i>Eliminar
        </x-wire-button>
    </form>
    @endcan
</div>
