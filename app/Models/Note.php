<?php

namespace App\Models;

use App\Enums\TodoStatus;
use App\NoteCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content',
        'parent_id',
        'previous_id',
        'next_id',
        'user_id',
        'todo_status',
        'pinned',
    ];


    protected $casts = [
        'todo_status' => TodoStatus::class,
        'pinned' => 'boolean',
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
