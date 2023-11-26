<?php

namespace App\Livewire;

use App\Enums\TodoStatus;
use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

class ShowNotes extends Component
{
    public $parent = null;
    public $note_type = 'all';

    public $new_note = '';

    public function getNotesProperty(): Collection
    {
        $notes = auth()->user()->notes()->withCount('children');

        if ($this->note_type === 'todos') {
            $notes = $notes->where('todo_status', '<>', null);
        }

        if ($this->note_type === 'notes') {
            $notes = $notes->whereNull('todo_status');
        }

        return $notes->get()->threaded($this->parent);
    }

    public function setParent($parent_id): void
    {
        $this->reset('note_type');
        $this->parent = $parent_id;
    }

    public function setPinned($id): void
    {
        $this->dispatch('set-pinned-note', $id)->to(PinnedNoteModal::class);
    }

    public function getPinnedNotesProperty(): Collection
    {
        return auth()->user()->notes()->wherePinned(true)->get();
    }

    public function getCollectionsProperty(): Collection
    {
        return auth()->user()->notes()->has('children')->get();
    }

    public function resetNotes(): void
    {
        $this->reset('parent', 'note_type');
    }

    public function addNote(): void
    {
        $this->validate(
            [
                'new_note' => 'required',
            ]
        );

        $todo = null;
        if (Str::startsWith($this->new_note, ['@todo', '@Todo', '@TODO'])) {
            $this->new_note = Str::after($this->new_note, ' ');
            $todo = TodoStatus::Pending;
        }

        if (Str::startsWith($this->new_note, 'http')) {
            $this->new_note = '<a href="' . $this->new_note . '" target="_blank">' . $this->new_note . '</a>';
        }

        Note::create(
            [
                'user_id' => auth()->id(),
                'parent_id' => $this->parent,
                'content' => $this->new_note,
                'todo_status' => $todo,
            ]
        );

        $this->reset('new_note');
    }

    public function render()
    {
        return view('livewire.show-notes');
    }
}
