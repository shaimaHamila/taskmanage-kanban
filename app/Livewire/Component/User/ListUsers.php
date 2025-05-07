<?php

namespace App\Livewire\Component\User;

use Livewire\Component;
use App\Models\User;

class ListUsers extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();  // Fetch all users from the database
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete(); // Delete the user from the database
            $this->users = User::all(); // Refresh the user list
        }
    }
    public function render()
    {
        return view('livewire.component.user.list-users');
    }
}
