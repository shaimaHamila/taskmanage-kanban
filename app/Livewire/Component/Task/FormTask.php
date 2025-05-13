<?php

namespace App\Livewire\Component\Task;

use Livewire\Component;
use App\Models\Task;
use App\Livewire\Forms\TaskType;
use App\Models\User;
use App\Enums\TaskStatus;
use Exception;
use Livewire\Attributes\On;

class FormTask extends Component
{

    public $editingTaskId = null;

    #[On('save-task')]
    public function saveTask($data)
    {
        $taskId = $data['taskId'];
        $newTask = $data['newTask'];
        if ($taskId) {
            $this->findTaskOrFail($taskId);
        }
        try {
            Task::updateOrCreate(
                ['id' => $taskId],
                $newTask
            );

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => $taskId ? 'Task updated successfully.' : 'Task created successfully.',
            ]);

            $this->dispatch('update-tasks-list');
        } catch (Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ]);
        }
    }
    public function updateTaskStatus($taskId, $newStatus)
    {
        $this->resetErrorBag();

        $task = $this->findTaskOrFail($taskId);

        if (!in_array($newStatus, TaskStatus::values())) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Invalid status value.',
            ]);
            return;
        }

        $task->update(['status' => $newStatus]);

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Task status updated successfully.',
        ]);

        $this->dispatch('update-tasks-list');
    }
    public function findTaskOrFail($taskId)
    {
        $task = Task::findOrFail($taskId);
        return $task;
    }

    public function render()
    {
        return view('livewire.component.task.form-task');
    }
}
