<?php

namespace App\Livewire\Component\User;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class UserDetails extends Component
{
    public $user;
    public $isDrawerOpen = false;

    public function closeDrawer()
    {
        $this->isDrawerOpen = false;
    }

    #[On('open-user-details')]
    public function handleOpenUserDetails($userId)
    {
        $this->user = User::find($userId);

        if (!$this->user) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'User not found.',
            ]);
            return;
        }

        $this->isDrawerOpen = true;
    }

    public function render()
    {
        return view('livewire.component.user.user-details');
    }
}
