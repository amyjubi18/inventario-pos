<div>
    <x-wire-card class="mb-6 font-semibold text-gray-900 text-gray-2xl dark:text-white">
        <h1>Importar productos desde Excel</h1>

        <div class="mt-4">
            <x-wire-button blue wire:click="downloadTemplate">
                <i class="fas fa-file-excel"></i> Descargar Plantilla
            </x-wire-button>
        </div>

        <p class="mt-1 text-sm text-gray-500">
            Complete la plantilla con los datos de tus productos y luego súbela hasta aquí.
        </p>
        <div class="mt-4">
            <input type="file" accept=".xlsx,.xls" wire:model="file" wire:loading.attr="disabled" wire:target="file"/>
            <x-input-error for="file" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-wire-button type="button" green wire:click="importProducts" wire:loading.attr="disabled" wire:target="file" spinner="importProducts">
                <i class="mr-2 fas fa-upload"></i>
                Importar Productos
            </x-wire-button>
        </div>
        @if (count($errors))
        <div class="mt-4">
            <div class="p-4 mb-3 text-yellow-800 bg-yellow-100 border border-yellow-300 rounded-md">
                @if ($importedCount)
                <i class="mr-2 fas fa-triangle-exclamation "></i>
                <strong>Importacion completada parcialmenute</strong>
                <p class="mt-1 text-sm">Algunos productos no se pudieron importar debido a errores</p>
                @else
                <i class="mr-2 fas fa-xmark "></i>
                <strong>No se importo ningun producto</strong>
                <p class="mt-1 text-sm">Todos los productos tienen errores o el archivo no es valido.</p>
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
        {{-- <form wire:submit.prevent="import" class="mt-6 space-y-4">
            <div>
                <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seleccionar archivo Excel</label>
                <input type="file" id="file" wire:model="file" accept=".xlsx,.xls" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('file') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <x-wire-button type="submit" blue :disabled="$importing">
                <i class="fas fa-upload"></i>
                @if($importing)
                    Importando...
                @else
                    Importar Productos
                @endif
            </x-wire-button>
        </form>

        @if($importing)
            <div class="p-4 mt-4 text-blue-700 bg-blue-100 border border-blue-400 rounded">
                Procesando archivo... Por favor espera.
            </div>
        @endif

        @if(!empty($importResults))
            <div class="mt-4 space-y-2">
                @foreach($importResults as $result)
                    <div class="p-3 rounded {{ $result['type'] === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}">
                        {{ $result['message'] }}
                    </div>
                @endforeach
            </div>
        @endif --}}
    </x-wire-card>
</div>

