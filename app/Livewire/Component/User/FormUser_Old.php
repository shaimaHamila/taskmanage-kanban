<?php

namespace App\Livewire\Component\User;

use App\Models\User;
use App\Livewire\Forms\UserType;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Role;
use Exception;
use Illuminate\Validation\ValidationException;

class FormUser_Old extends Component
{
    public UserType $user;
    public $editingUserId = null;
    public $roles = [];


    public function mount($userId = null)
    {
        $this->roles = Role::all();

        $this->resetErrorBag();
        $this->user->reset();
        $this->editingUserId = null;

        // If editing an existing user, load the data.
        if ($userId) {
            $userToUpdate = User::findOrFail($userId);
            $this->user->firstName = $userToUpdate->firstName;
            $this->user->lastName = $userToUpdate->lastName;
            $this->user->email = $userToUpdate->email;
            $this->user->role_id = $userToUpdate->role_id;
            $this->user->password = ''; // Don't pre-fill password for security reasons
            $this->editingUserId = $userToUpdate->id;
        } else {
            $this->editingUserId = null;
        }
    }

    public function saveUser()
    {
        // Prepare base rules
        $rules = [
            'role_id' => 'required',
            'firstName' => 'required|string|min:2',
            'lastName' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email,' . ($this->editingUserId ?? 'NULL') . ',id',
            'password' => 'nullable|string|min:8', // By default, password is nullable
        ];

        // If we are creating a new user, make password required
        if (!$this->editingUserId) {
            $rules['password'] = 'required|string|min:8';
        }

        // Now apply the rules
        $this->validateUserData($rules);
        try {

            if (!$this->editingUserId && User::where('email', $this->user->email)->exists()) {
                $this->dispatch('alert', [
                    'type' => 'error',
                    'message' => 'Email already exists.',
                    'timer' => 6000,
                ]);
                return;
            }

            $data = $this->prepareUserData($this->editingUserId !== null);
            // Only update password if provided
            if (!empty($this->user->password)) {
                $data['password'] = bcrypt($this->user->password);
            }

            User::updateOrCreate(
                ['id' => $this->editingUserId],
                $data
            );

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => $this->editingUserId ? 'User updated successfully.' : 'User created successfully.',
            ]);

            $this->closeDrawer();
        } catch (ValidationException $e) {
            // Silent if validation fails
        } catch (Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => "Error occurred, please try again.",
                'timer' => 6000,
            ]);
        }
    }


    // Prepare the user data (handle password hashing).
    private function prepareUserData($updating = false)
    {
        $userData = [
            'firstName' => $this->user->firstName,
            'lastName' => $this->user->lastName,
            'email' => $this->user->email,
            'role_id' => $this->user->role_id,
        ];

        // If updating, only hash password if provided.
        if (!$updating || !empty($this->user->password)) {
            $userData['password'] = Hash::make($this->user->password);
        }

        return $userData;
    }

    // Validate user data.
    private function validateUserData($rules)
    {
        $this->user->validate($rules);
    }


    public function render()
    {

        return view('livewire.component.user.form-user', [
            'editingUserId' => $this->editingUserId,
        ]);
    }
}
