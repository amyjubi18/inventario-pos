<x-modal-card wire:model="form.open" width="lg" blur-xl>
    <p class="mb-2 text-lg text-center">
        Enviar email

    </p>
    <p class="mb-2 text-lg text-center uppercase">
        {{ $form['document'] }}

    </p>
    <p class="mb-2 text-center uppercase">
        {{ $form['client'] }}
    </p>
    <form wire:submit='sendEmail'>
        <x-wire-input
            wire:model="form.email"
            label="Correo electrónico"
            type="email"
            class="mb-4"
        />
        <x-wire-button type="submit" class="justify-center w-full mb-4" blue>
            Enviar
        </x-wire-button>
    </form>

</x-modal-card>
