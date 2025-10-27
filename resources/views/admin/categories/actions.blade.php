<div class="flex items-center space-x-2">
    @can('update-categories')


    <x-wire-button href="{{ route('admin.categories.edit', $category) }}" green xs>
    <i class="fas fa-edit "> </i>Editar</x-wire-button>
    @endcan
    @can('delete-categories')


    <form action="{{ route('admin.categories.destroy', $category) }}" method="post" class="delete-form">
        @csrf
        @method('DELETE')
        <x-wire-button type="submit" red xs>
        <i class="fas fa-trash-alt"> </i>Eliminar
        </x-wire-button>
    </form>
    @endcan
</div>
