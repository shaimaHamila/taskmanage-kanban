<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UserType extends Form
{
    #[Validate('required|string|min:2')]
    public $firstName;

    #[Validate('required|string|min:2')]
    public $lastName;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:6')]
    public $password;

    #[Validate('required|exists:roles,id')]
    public $role_id;
}
