<x-dialog-modal wire:model="show">
    <x-slot name="title">
        @if($editing)
            Edit note
        @else
            Pinned note
        @endif
    </x-slot>

    <x-slot name="content">
        @if($editing)

            <textarea
                wire:model="new_note"
                rows="10"
                class="w-full bg-blue-50 dark:bg-slate-950 text-slate-800 dark:text-amber-50 mb-2 rounded"
                placeholder="Write something..."></textarea>

        @else
            <div class="p-4 md:p-5 space-y-4 prose dark:prose-invert text-gray-500 dark:text-gray-200">

                {{ $note?->content }}

            </div>
        @endif
    </x-slot>

    <x-slot name="footer">
        @if($editing)
            <x-secondary-button class="mr-2" wire:click="save()" wire:loading.attr="disabled">
                Save
            </x-secondary-button>
        @else
            <x-secondary-button class="mr-2" wire:click="togglePin()" wire:loading.attr="disabled">
                Unpin note
            </x-secondary-button>
        @endif
        <x-button wire:click="$toggle('show')" wire:loading.attr="disabled">
            Close
        </x-button>
    </x-slot>
</x-dialog-modal>
