<x-dialog-modal wire:model="show">
    <x-slot name="title">
        Pinned note
    </x-slot>

    <x-slot name="content">
        <div class="p-4 md:p-5 space-y-4">
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-200">
                {{ $this->note?->content }}
            </p>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button class="mr-2" wire:click="togglePin()" wire:loading.attr="disabled">
            Unpin note
        </x-secondary-button>

        <x-button wire:click="$toggle('show')" wire:loading.attr="disabled">
            Close
        </x-button>
    </x-slot>
</x-dialog-modal>
