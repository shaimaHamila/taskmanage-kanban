<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Enums\TaskStatus;

class TaskType extends Form
{
    public $id;
    #[Validate('required|string|min:3')]
    public $title;

    #[Validate('nullable|string')]
    public $description;
    #[Validate('required|enum:' . TaskStatus::class)]
    public $status;

    #[Validate('required|exists:users,id')]
    public $user_id;
}
