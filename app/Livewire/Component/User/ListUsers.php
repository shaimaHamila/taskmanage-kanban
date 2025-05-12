<?php

namespace App\Livewire\Component\User;

use Livewire\Component;
use App\Models\User;
use Livewire\Livewire;

class ListUsers extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::latest()->get();
    }
    protected $listeners = ['update-users-list' => 'refreshUsers'];
    public function refreshUsers()
    {
        $this->users = User::latest()->get();
        //reload the component

    }
    public function openUserDetails($userId)
    {
        $this->dispatch('open-user-details', userId: $userId);
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            $this->refreshUsers();

            // Success alert
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'User deleted successfully.',
            ]);
        } else {
            // Error alert
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'User not found.',
            ]);
        }
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
