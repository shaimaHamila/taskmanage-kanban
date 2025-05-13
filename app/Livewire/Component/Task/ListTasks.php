<?php

namespace App\Livewire\Component\Task;

use App\Livewire\Forms\TaskType;
use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ListTasks extends Component
{
    public $tasks;
    public $showNewTaskInput = null; // holds the column key
    public TaskType $newTask;

    public function mount()
    {
        $user = Auth::user();

        if ($user->role->roleName === 'admin') {
            $this->tasks = Task::latest()->get();
        } elseif ($user->role->roleName === 'employee') {
            $this->tasks = Task::where('user_id', $user->id)->latest()->get();
        } else {
            $this->tasks = collect(); // empty collection
        }
    }

    public function handleShowNewTaskInput($key)
    {
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
                'message' => 'Only Admins can create or update a task.',
            ]);
            return;
        } else {
            $this->newTask->status = $this->showNewTaskInput;
            $this->newTask->created_at = now();
            $taskId = null;
            //Dispatch create task event
            $this->dispatch('save-task', ['taskId' => $taskId, 'newTask' => $this->newTask->toArray()]);
            $this->newTask->reset();
            $this->showNewTaskInput = null;
            $this->dispatch('loadTasks');
        }
    }

    public function deleteTask($taskId)
    {
        $user = Auth::user();

        if ($user->role->roleName !== 'admin') {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Only Admins can delete a task.',
            ]);
            return;
        }

        try {
            $task = Task::findOrFail($taskId);
            $task->delete();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Task deleted successfully.',
            ]);

            // 👇 Custom event to refresh task list
            $this->dispatch('loadTasks');
        } catch (ModelNotFoundException $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Task not found.',
            ]);
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'An error occurred while deleting the task.',
            ]);
        }
    }

    protected $listeners = ['loadTasks' => 'loadTasks'];
    public function loadTasks()
    {
        $this->tasks = Task::latest()->get();
    }
    public function render()
    {
        return view('livewire.component.task.list-tasks');
    }
}
