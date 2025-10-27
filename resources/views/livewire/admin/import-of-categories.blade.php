<div>
    <x-wire-card class="mb-6 font-semibold text-gray-900 text-gray-2xl dark:text-white">
        <h1>Importar categorias desde Excel</h1>

        <div class="mt-4">
            <x-wire-button blue wire:click="downloadTemplate">
                <i class="fas fa-file-excel"></i> Descargar Plantilla
            </x-wire-button>
        </div>

        <p class="mt-1 text-sm text-gray-500">
            Complete la plantilla con los datos de tus categorias y luego súbela hasta aquí.
        </p>
        <div class="mt-4">
            <input type="file" accept=".xlsx,.xls" wire:model="file" wire:loading.attr="disabled" wire:target="file"/>
            <x-input-error for="file" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-wire-button type="button" green wire:click="importCategories" wire:loading.attr="disabled" wire:target="file" spinner="importCategories">
                <i class="mr-2 fas fa-upload"></i>
                Importar Categorias
            </x-wire-button>
        </div>
        @if (count($errors))
        <div class="mt-4">
            <div class="p-4 mb-3 text-yellow-800 bg-yellow-100 border border-yellow-300 rounded-md">
                @if ($importedCount)
                <i class="mr-2 fas fa-triangle-exclamation "></i>
                <strong>Importacion completada parcialmenute</strong>
                <p class="mt-1 text-sm">Algunas categorias no se pudieron importar debido a errores</p>
                @else
                <i class="mr-2 fas fa-xmark "></i>
                <strong>No se importo ninguna categoria</strong>
                <p class="mt-1 text-sm">Todas las categorias tienen errores o el archivo no es valido.</p>
                @endif
            </div>
            <ul class="space-y-2">
                @foreach ($errors as $error)
                <li class="p-3 border border-red-200 rounded-md bg-red-50">
                    <p class="font-semibold text-red-700">
                        <i class="fas fa-file-pen"></i>
                        Fila{{ $error['row'] }}:
                    </p>
                    <ul class="mt-1 list-disc list-inside">
                        @foreach ($error['errors'] as $message)
                        <li class="text-sm text-red-600">
                            {{ $message }}
                        </li>
                        @endforeach
                    </ul>

                </li>
                @endforeach
            </ul>
        </div>
        @endif
        </x-wire-card>
</div>
