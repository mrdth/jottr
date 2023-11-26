<?php

namespace App\Livewire;

use App\Enums\TodoStatus;
use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowNotes extends Component
{
    public $parent = null;
    public $note_type = 'all';

    public $new_note = '';

    public function getNotesProperty(): Collection
    {
        $notes = request()
            ->user()
            ->notes()
            ->withCount('children')
            ->where(
                function ($query) {
                    $query->where('todo_status', '<>', TodoStatus::Completed)
                        ->orWhereNull('todo_status');
                }
            );

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

        $this->authorize('view', Note::find($parent_id));

        $this->parent = $parent_id;
    }

    public function setPinned($id): void
    {
        $this->authorize('view', Note::find($id));
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

        $collection = false;
        if (Str::startsWith($this->new_note, '@collection')) {
            $this->new_note = Str::after($this->new_note, ' ');
            $collection = true;
        }

        if (Str::startsWith($this->new_note, 'http')) {
            $this->new_note = '<a href="' . $this->new_note . '" target="_blank">' . $this->new_note . '</a>';
        }

        $note = auth()->user()->notes()->create(
            [
                'parent_id' => $this->parent,
                'content' => trim($this->new_note),
                'todo_status' => $todo,
            ]
        );

        if ($collection) {
            $this->parent = $note->id;
        }
        $this->reset('new_note');
    }

    public function completeTodo(Note $note): void
    {
        $this->authorize('update', $note);

        $note->update(['todo_status' => TodoStatus::Completed]);

        $note->children()->update(['parent_id' => $note->parent_id]);
        $note->delete();
    }

    public function togglePin(Note $note): void
    {
        $this->authorize('update', $note);

        $note->update(['pinned' => !$note->pinned]);
    }

    public function toggleTodo(Note $note): void
    {
        $this->authorize('update', $note);

        $status = $note->todo_status === null ? TodoStatus::Pending : null;

        $note->update(['todo_status' => $status]);
    }

    public function deleteNote(Note $note): void
    {
        $this->authorize('delete', $note);

        $note->children()->update(['parent_id' => $note->parent_id]);
        $note->delete();
    }

    #[On('note-unpinned')]
    public function unpinNote(Note $note): void
    {
        $this->authorize('update', $note);

        $this->togglePin($note);
    }

    public function render()
    {
        return view('livewire.show-notes');
    }
}
