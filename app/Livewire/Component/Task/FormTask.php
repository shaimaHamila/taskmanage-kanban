<?php

namespace App\Livewire\Component\Task;

use Livewire\Component;
use App\Models\Task;
use App\Livewire\Forms\TaskType;
use App\Models\User;
use App\Enums\TaskStatus;
use Exception;
use Illuminate\Support\Facades\Auth;

class FormTask extends Component
{
    public TaskType $task;
    public $editingTaskId = null;
    public $users = [];


    public function mount()
    {
        $this->users = User::all();
    }
    public function addOrUpdateTask($taskId = null)
    {

        $this->resetErrorBag();
        $this->task->reset();

        // If editing an existing task, load the data.
        if ($taskId) {
            $taskToUpdate = Task::findOrFail($taskId);
            $this->task->title = $taskToUpdate->title;
            $this->task->description = $taskToUpdate->description;
            $this->task->user_id = $taskToUpdate->user_id;
            $this->editingTaskId = $taskToUpdate->id;
        } else {
            $this->editingTaskId = null;
        }
    }
    public function saveTask()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Only Admins can create or update a task.',
            ]);
            return;
        }
        $this->task->validate();
        try {

            Task::updateOrCreate(
                ['id' => $this->editingTaskId],
                $this->task->toArray()
            );

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => $this->editingTaskId ? 'task updated successfully.' : 'task created successfully.',
            ]);
            $this->dispatch('update-tasks-list'); // Refresh the tasks list

        } catch (Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'An error occurred:' . $e->getMessage(),
            ]);
            return;
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
