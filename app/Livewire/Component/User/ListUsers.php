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
            $user->delete();
            $this->users = User::all();
        }
        // Trigger SweetAlert
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'User deleted successfully.',
            'position' => 'center',
        ]);
    }
    public function updateUserHandler($userId)
    {

        $this->dispatch('open-user-form', $userId);
    }
    public function render()
    {
        return view('livewire.component.user.list-users');
    }
}
