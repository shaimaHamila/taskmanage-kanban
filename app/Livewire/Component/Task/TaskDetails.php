<?php

namespace App\Livewire\Component\Task;

use Livewire\Component;
use App\Models\Task;
use Livewire\Attributes\On;

class TaskDetails extends Component
{

    public $task;
    public $isDrawerOpen = false;

    public function closeDrawer()
    {
        $this->isDrawerOpen = false;
    }

    #[On('open-task-details-drawer')]
    public function handleOpenTaskDetails($taskId)
    {
        $this->task = Task::find($taskId);

        if (!$this->task) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Task not found.',
            ]);
            return;
        }

        $this->isDrawerOpen = true;
    }

    public function render()
    {
        return view('livewire.component.task.task-details');
    }
}
