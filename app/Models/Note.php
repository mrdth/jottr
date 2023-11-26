<?php

namespace App\Models;

use App\Enums\TodoStatus;
use App\NoteCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'parent_id',
        'previous_id',
        'next_id',
        'user_id',
        'todo_status',
    ];


    protected $casts = [
        'todo_status' => TodoStatus::class,
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function children(): hasMany
    {
        return $this->hasMany(Note::class, 'parent_id');
    }


    public function newCollection(array $models = []): NoteCollection
    {
        return new NoteCollection($models);
    }
}
