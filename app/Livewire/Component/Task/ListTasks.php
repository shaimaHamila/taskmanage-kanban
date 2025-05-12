<?php

namespace App\Livewire\Component\Task;

use App\Livewire\Forms\TaskType;
use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class ListTasks extends Component
{
    public $tasks;
    public $showNewTaskInput = null; // holds the column key
    public TaskType $newTask;

    public function mount()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $this->tasks = Task::latest()->get();
        } elseif ($user->role === 'employee') {
            $this->tasks = Task::where('user_id', $user->id)->latest()->get();
        } else {
            $this->tasks = collect(); // empty collection
        }
    }

    public function handleShowNewTaskInput($key)
    {
        $this->showNewTaskInput = $key;
        $this->newTask->title = '';
    }

    public function createTask($status)
    {
        $user = Auth::user();

        if (empty($this->newTaskTitle)) {
            $this->showNewTaskInput = null;
            return;
        }

        //Dispatch create task event

        $this->newTask->title = '';
        $this->showNewTaskInput = null;

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Task created successfully.',
        ]);
    }

    public function render()
    {
        return view('livewire.component.task.list-tasks');
    }
}
