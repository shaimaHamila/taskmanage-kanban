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
    }
    public function openUserDetails($userId)
    {
        $user = User::find($userId);

        // Dynamically passing user data to the drawer body
        $content = view('livewire.component.user.user-details', compact('user'))->render();
        $this->dispatch('open-drawer', [
            'content' => $content,
            'drawerTitle' => 'User Details',
        ]);
    }
    // public function createOrUpdateUserHandler($userId = null)
    // {
    //     // Check if userId is provided
    //     if ($userId) {
    //         // If userId is provided, we will update the user and pass only the id to the form
    //         $content = (new \App\Livewire\Component\User\FormUser(userId: $userId))->render()->render();


    //         $this->dispatch('open-drawer', [
    //             'content' => $content,
    //             'drawerTitle' => $userId ? 'Update user' : 'Create user',
    //         ]);
    //     } else {
    //         // If no userId is provided, we will create a new user
    //         $content = view('livewire.component.user.form-user', ['userId' => null])->render();
    //         $this->dispatch('open-drawer', [
    //             'content' => $content,
    //             'drawerTitle' => 'Create user',
    //         ]);
    //     }
    // }
    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            $this->users = User::all();

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
