<?php

namespace App\Livewire\Component\Task;

use App\Livewire\Forms\TaskType;
use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ListTasks extends Component
{
    public $tasks;
    public $showNewTaskInput = null;
    public TaskType $newTask;

    protected $listeners = ['loadTasks' => 'loadTasks', 'updateTaskOrder'];

    // Status configuration for reuse
    protected $statuses = [
        'TODO' => ['label' => 'TODO', 'color' => 'gray'],
        'IN_PROGRESS' => ['label' => 'IN PROGRESS', 'color' => 'blue'],
        'IN_REVIEW' => ['label' => 'IN REVIEW', 'color' => 'yellow'],
        'DONE' => ['label' => 'DONE', 'color' => 'green'],
        'CANCELLED' => ['label' => 'CANCELLED', 'color' => 'red'],
    ];

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks()
    {
        $user = Auth::user();

        if ($user->role->roleName === 'admin') {
            $this->tasks = Task::with('user')->orderBy('order')->get();
        } elseif ($user->role->roleName === 'employee') {
            $this->tasks = Task::with('user')
                ->where('user_id', $user->id)
                ->orderBy('order')
                ->get();
        } else {
            $this->tasks = collect();
        }
    }

    public function handleShowNewTaskInput($key)
    {
        if (!array_key_exists($key, $this->statuses)) {
            Log::warning('Invalid status key', ['key' => $key]);
            return;
        }
        $this->showNewTaskInput = $key;
    }

    public function createTask()
    {
        $user = Auth::user();

        if (empty($this->newTask->title)) {
            $this->showNewTaskInput = null;
            $this->newTask->reset();
            return;
        }

        if ($user->role->roleName !== 'admin') {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Only Admins can create tasks.',
            ]);
            return;
        }

        try {
            $this->newTask->status = $this->showNewTaskInput;
            $this->newTask->created_at = now();
            $this->newTask->order = (Task::max('order') ?? 0) + 1;

            $taskData = $this->newTask->toArray();
            Task::create($taskData);

            $this->newTask->reset();
            $this->showNewTaskInput = null;
            $this->dispatch('loadTasks');

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Task created successfully.',
            ]);
        } catch (Exception $e) {
            Log::error('Failed to create task', ['error' => $e->getMessage()]);
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Failed to create task.',
            ]);
        }
    }

    public function handleTaskUpdate($taskId)
    {
        if (Auth::user()->role->roleName !== 'admin') {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Only Admins can update tasks.',
            ]);
            return;
        }
        $this->dispatch('open-task-update-drawer', $taskId);
    }

    public function deleteTask($taskId)
    {
        if (Auth::user()->role->roleName !== 'admin') {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Only Admins can delete tasks.',
            ]);
            return;
        }

        try {
            $task = Task::findOrFail($taskId);
            $task->delete();

            $this->dispatch('loadTasks');
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Task deleted successfully.',
            ]);
        } catch (ModelNotFoundException) {
            Log::warning('Task not found for deletion', ['taskId' => $taskId]);
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Task not found.',
            ]);
        } catch (Exception $e) {
            Log::error('Failed to delete task', ['taskId' => $taskId, 'error' => $e->getMessage()]);
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Failed to delete task.',
            ]);
        }
    }


    public function handleTaskDetails($taskId)
    {
        $this->dispatch('open-task-details-drawer', $taskId);
    }


    public function updateTaskOrder($status, $orderedIds)
    {

        if (!array_key_exists($status, $this->statuses)) {
            Log::warning('Invalid status received', ['status' => $status]);
            return;
        }

        if (empty($orderedIds)) {
            Log::warning('No ordered IDs received', ['status' => $status]);
            return;
        }

        try {
            dd("fffffffffffffffff");
            DB::transaction(function () use ($status, $orderedIds) {
                foreach ($orderedIds as $index => $id) {
                    if (!Task::where('id', $id)->exists()) {
                        Log::warning('Invalid task ID', ['id' => $id]);
                        continue;
                    }
                    Task::where('id', $id)->update([
                        'status' => $status,
                        'order' => $index + 1,
                    ]);
                }
            });

            $this->loadTasks();
            Log::info('Task order updated', ['status' => $status, 'orderedIds' => $orderedIds]);
        } catch (Exception $e) {
            Log::error('Failed to update task order', [
                'status' => $status,
                'orderedIds' => $orderedIds,
                'error' => $e->getMessage(),
            ]);
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Failed to update task order.',
            ]);
        }
    }
    public function taskDropped($data)
    {
        $task = \App\Models\Task::find($data['taskId']);

        if (!$task) return;

        $task->update([
            'status' => $data['toStatus'],
            'order' => $data['newOrder'],
        ]);

        // Normalize order in new column
        $tasks = \App\Models\Task::where('status', $data['toStatus'])->orderBy('order')->get();

        foreach ($tasks as $index => $t) {
            $t->update(['order' => $index]);
        }
    }

    public function render()
    {
        return view('livewire.component.task.list-tasks', [
            'statuses' => $this->statuses,
        ]);
    }
}
