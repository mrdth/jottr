<li @class([
        "w-full  pt-4 my-2 text-black shadow sm:pt-8 dark:text-white",
        "pl-4 sm:pl-8" => $note->parent_id
])>
    <div class="header">
        <h2 class="flex justify-between">
            <div>id: {{ $note->id }}</div>
            @if($note->todo_status !== null)
                <div>TODO</div>
            @endif
            <div>parent: {{ $note->parent_id }}</div>
        </h2>

    </div>
    <div class="body pb-4 sm:pb-8 border-b border-gray-200 dark:border-gray-700 prose lg:prose-xl dark:prose-invert">
        @markdown($note->content)
    </div>

    @if (isset($this->notes[$note->id]))
        <x-notes.list :notes="$this->notes[$note->id]"/>
    @endif
</li>
