<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Attributes\On;
use Livewire\Component;

class PinnedNoteModal extends Component
{
    public ?Note $note = null;
    public bool $show = false;

    public function render()
    {
        return view('livewire.pinned-note-modal');
    }

    #[On('set-pinned-note')]
    public function updateNote($id): void
    {
        $this->note = Note::find($id);
        $this->show = true;
    }
}
