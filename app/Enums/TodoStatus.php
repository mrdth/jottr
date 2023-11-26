<?php

namespace App\Enums;

enum TodoStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function label(): string
    {
        return match ($this) {
            static::Pending => 'To Do',
            static::InProgress => 'In Progress',
            static::Completed => 'Done',
        };
    }

    public static function values(): array
    {
        return [
            static::Pending,
            static::InProgress,
            static::Completed,
        ];
    }
}
