<div class="flex flex-wrap gap-1">
    @forelse ($permissions as $permission)
        <x-wire-badge indigo>
            {{ $permission->name }}
        </x-wire-badge>

    @empty
        <x-wire-badge secondary>
            Sin Permisos
        </x-wire-badge>

    @endforelse
</div>
