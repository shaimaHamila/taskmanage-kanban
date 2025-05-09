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

class FormUser extends Component
{
    public UserType $user;
    public $editingUserId = null;
    public $isDrawerOpen = false;
    public $roles = [];
    protected $listeners = ['openUserForm'];

    #[On('open-user-form')]
    public function openUserForm($userId = null)
    {
        $this->resetErrorBag();
        $this->user->reset();

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

        $this->isDrawerOpen = true;
    }

    public function saveUser()
    {

        // Prepare base rules
        $rules = [
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
        $this->user->validate($rules);
        try {

            if (!$this->editingUserId && User::where('email', $this->user->email)->exists()) {

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

            $this->dispatch('update-users-list'); // Refresh the user list
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
    private function validateUserData()
    {
        $this->user->validate();
    }

    // Close the drawer.
    public function closeDrawer()
    {
        $this->isDrawerOpen = false;
        $this->user->reset();
        $this->editingUserId = null;
    }

    public function render()
    {
        $this->roles = Role::all();

        return view('livewire.component.user.form-user', [
            'roles' => $this->roles,
        ]);
    }
}
