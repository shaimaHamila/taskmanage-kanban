<?php

namespace App\Livewire\Component\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $user = User::where('email', $this->email)->first();
        if (!$user) {
            $this->addError('email', 'This email is not registered.');
            session()->flash('LoginError', 'Email not found.');
            return;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'The password is incorrect.');
            session()->flash('LoginError', 'Incorrect password.');
            return;
        }

        Auth::login($user);
        return redirect()->route('tasks');
    }
    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('tasks');
        }
    }
    public function render()
    {
        return view('livewire.component.auth.login');
    }
}
