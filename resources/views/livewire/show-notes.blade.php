<div class="">
    <x-notes.sidebar/>
    <div class="h-screen sm:ml-64 flex flex-col justify-between">
        <div class="mx-auto w-3/4 px-4 overflow-auto">
            <x-notes.list :notes="$this->notes['root']"/>

        </div>
        <textarea
            id="note-input"
            wire:model="new_note"
            wire:keydown.ctrl.enter="addNote"
            aria-label="Add a new note"
            class="mx-auto mb-4 h-32 w-3/4 bg-blue-50 dark:bg-slate-950 text-slate-800 dark:text-amber-50"
            placeholder="Add a note - CTRL + Enter to save"></textarea>
    </div>

    <livewire:pinned-note-modal/>
</div>
