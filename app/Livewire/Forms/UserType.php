<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UserType extends Form
{
    public $id;

    #[Validate('required')]
    public $role_id;
    #[Validate('required|string|min:2')]
    public $firstName;

    #[Validate('required|string|min:2')]
    public $lastName;

    #[Validate('required|email')]
    public $email;
    public $password;
}
