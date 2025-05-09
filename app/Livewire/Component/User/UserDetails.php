<?php

namespace App\Livewire\Component\User;

use Livewire\Component;

class UserDetails extends Component
{
    public $user;
    public function render()
    {
        return view('livewire.component.user.user-details');
    }
}
