<?php

namespace App\Livewire\Component\Task;

use App\Livewire\Forms\TaskType;
use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ListTasks extends Component
{
    public $tasks;
    public $showNewTaskInput = null;
    public TaskType $newTask;

    protected $listeners = ['loadTasks' => 'loadTasks', 'updateTaskOrder'];

    public function mount()
    {

        $this->loadTasks(); // ✅ Load tasks on mount
    }

    public function loadTasks()
    {
        $user = Auth::user();

        if ($user->role->roleName === 'admin') {
            $this->tasks = Task::orderBy('order')->get();
        } elseif ($user->role->roleName === 'employee') {
            $this->tasks = Task::where('user_id', $user->id)->orderBy('order')->get();
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
        }

        $this->newTask->status = $this->showNewTaskInput;
        $this->newTask->created_at = now();
        $this->newTask->order = (Task::max('order') ?? 0) + 1;

        $taskId = null;
        //Dispatch create task event
        $this->dispatch('save-task', ['taskId' => $taskId, 'newTask' => $this->newTask->toArray()]);

        $this->newTask->reset();
        $this->showNewTaskInput = null;
        $this->dispatch('loadTasks');
    }

    public function handleTaskUpdate($taskId)
    {
        dd($taskId);
        $user = Auth::user();

        if ($user->role->roleName !== 'admin') {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Only Admins can update a task.',
            ]);
            return;
        }

        $this->dispatch('open-task-update-drawer', $taskId);
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
    public function fixAllTaskOrders()
    {
        $tasks = Task::orderBy('created_at')->get();

        foreach ($tasks as $index => $task) {
            $task->order = $index + 1;
            $task->save();
        }
    }

    public function handleTaskDetails($taskId)
    {
        $this->dispatch('open-task-details-drawer', $taskId);
    }

    public function updateTaskOrder($status, $orderedIds)
    {
        DB::transaction(function () use ($status, $orderedIds) {
            foreach ($orderedIds as $index => $id) {
                Task::where('id', $id)->update([
                    'status' => $status,
                    'order' => $index + 1,
                ]);
            }
        });

        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.component.task.list-tasks');
    }
}
