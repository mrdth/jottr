<div class="ms-3 relative">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <x-fbi-outline.general.dots-vertical
                class="w-8 h-8 hover:bg-gray-200 dark:hover:bg-gray-600 p-2 rounded-full  cursor-pointer"/>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link
                class="block px-4 py-2 text-xs text-gray-400 cursor-pointer"
                wire:click="togglePin({{ $note->id }})"
            >
                {{ $note->pinned ? 'Unpin note' : 'Pin note' }}
            </x-dropdown-link>

            @if(!array_key_exists($note->id, $this->notes->toArray()))
                <x-dropdown-link
                    class="block px-4 py-2 text-xs text-gray-400 cursor-pointer"
                    wire:click="$set('parent', {{ $note->id }})"
                >
                    {{ __('Convert to collection') }}
                </x-dropdown-link>
            @endif

            <x-dropdown-link
                class="block px-4 py-2 text-xs text-gray-400 cursor-pointer"
                wire:click="toggleTodo({{ $note->id }})"
            >
                {{ $note->todo_status === null ? 'Convert to todo' : 'Convert to note' }}
            </x-dropdown-link>


            <x-dropdown-link
                class="block px-4 py-2 text-xs text-gray-400 cursor-pointer"
                wire:click="deleteNote({{ $note->id }})"
                wire:confirm="Are you sure you want to delete this note?"
            >
                {{ __('Delete') }}
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>
