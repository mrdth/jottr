<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Component;

class PinnedNoteModal extends Component
{
    public ?Note $note = null;
    public bool $show = false;
    public bool $editing = false;
    public string $new_note = '';

    public function render()
    {
        return view('livewire.pinned-note-modal');
    }

    #[On('set-pinned-note')]
    public function showNote($id, $editing = false): void
    {
        $this->authorize('view', Note::find($id));
        $this->note = Note::find($id);

        $this->editing = $editing;
        if ($this->editing) {
            $this->new_note = $this->note->content;
        }

        $this->show = true;
    }

    public function togglePin(): void
    {
        $this->show = false;

        $this->dispatch('note-unpinned', $this->note)->to(ShowNotes::class);
    }

    public function save(): void
    {
        $this->show = false;

        if (!$this->new_note) {
            return;
        }

        $this->note->update(['content' => $this->new_note]);

        $this->dispatch('refresh')->to(ShowNotes::class);
    }
}
