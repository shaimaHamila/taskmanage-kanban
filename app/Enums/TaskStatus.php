<?php

namespace App\Enums;

enum TaskStatus: string
{
    case ToDo = 'TODO';
    case InProgress = 'IN_PROGRESS';
    case InReview = 'IN_REVIEW';
    case Done = 'DONE';
    case Cancelled = 'CANCELLED';
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
