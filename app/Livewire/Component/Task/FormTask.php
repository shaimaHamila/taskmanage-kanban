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
    public TaskType $task;
    public $users = [];
    public $taskStatus = TaskStatus::class;

    public function mount()
    {
        $this->users = User::where('role_id', 2)->get();
    }

    public $isDrawerOpen = false;

    public function closeDrawer()
    {
        $this->isDrawerOpen = false;
    }

    #[On('open-task-update-drawer')]
    public function handleOpenTaskUpdateDrawer($taskId)
    {

        $task = $this->findTaskOrFail($taskId);
        $this->editingTaskId = $taskId;
        $this->task->id = $task->id;
        $this->task->title = $task->title;
        $this->task->description = $task->description;
        $this->task->status = $task->status->value; // because it's an enum
        $this->task->user_id = $task->user_id;
        $this->task->created_at = $task->created_at;
        $this->task->updated_at = $task->updated_at;
        $this->task->order = $task->order;
        $this->isDrawerOpen = true;
    }



    #[On('save-task')]
    public function saveTask($data = null)
    {

        // For task creation, we require the newTask data
        $newTask = $this->editingTaskId ? $this->task->toArray() : $data['newTask'];
        try {
            Task::updateOrCreate(
                ['id' => $this->editingTaskId],
                $newTask
            );
            $this->dispatch('loadTasks');
            $this->closeDrawer();
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

        $this->dispatch('loadTasks');
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
