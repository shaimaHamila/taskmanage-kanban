<?php

namespace App\Enums;

enum TaskStatus: string
{
    case ToDo = 'TODO';
    case InProgress = 'IN_PROGRESS';
    case InReview = 'IN_REVIEW';
    case Done = 'DONE';
    case Cancelled = 'CANCELLED';
}
