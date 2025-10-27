<div>
    <x-datatable :columns="$columns" :rows="$rows" :modals="$modals" link="admin.shopping-carts.index">
        <x-slot name="buttons">
            {{-- Custom buttons can go here --}}
        </x-slot>
    </x-datatable>
</div>
