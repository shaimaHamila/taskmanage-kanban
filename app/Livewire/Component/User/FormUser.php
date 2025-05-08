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
        $this->validateUserData();
        try {

            $data = $this->prepareUserData($this->editingUserId !== null);

            // Check for email conflict if creating a new user
            if (!$this->editingUserId && User::where('email', $this->user->email)->exists()) {
                throw new Exception('Email already exists.');
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
                'message' => 'Something went wrong: ' . $e->getMessage(),
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
        $roles = Role::all(); // Get all roles

        return view('livewire.component.user.form-user', [
            'roles' => $roles
        ]);
    }
}
