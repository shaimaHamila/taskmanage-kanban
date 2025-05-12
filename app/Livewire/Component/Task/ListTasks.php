<?php

namespace App\Livewire\Component\Task;

use App;
use Livewire\Component;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class ListTasks extends Component
{
    public $tasks;

    public function mount()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $this->tasks = Task::latest()->get();
        } elseif ($user->role === 'employee') {
            $this->tasks = Task::where('user_id', $user->id)->latest()->get();
        } else {
            $this->tasks = collect(); // empty collection for unauthorized roles
        }
    }

    public function render()
    {
        return view('livewire.component.task.list-tasks');
    }
}
