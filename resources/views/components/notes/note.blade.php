<li @class([
        "w-full  pt-2 my-2 text-black shadow sm:pt-4 dark:text-white ",
        "pl-4 sm:pl-8" => $note->parent_id
])>
    <div class="header">
        <div class="flex justify-end">
            <x-notes.note-actions :note="$note"/>
        </div>

    </div>
    <div class="flex border-b border-gray-200 dark:border-gray-700">
        @if($note->todo_status !== null)
            <div class="todo-status pt-1 pr-3">
                <input type="checkbox" aria-label="Complete todo" wire:click="completeTodo({{ $note->id }})">
            </div>
        @endif
        <div
            class="body pb-2 sm:pb-4 prose lg:prose-xl dark:prose-invert max-w-full">
            @markdown($note->content)
        </div>

    </div>

    @if (isset($this->notes[$note->id]))
        <x-notes.list :notes="$this->notes[$note->id]"/>
    @endif
</li>
