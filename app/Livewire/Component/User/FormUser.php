<?php

namespace App\Livewire\Component\User;

use App\Models\User;
use App\Livewire\Forms\UserType;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Role;

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

    // Handle user creation.
    public function addUser()
    {
        $this->validateUserData();

        User::create($this->prepareUserData());

        session()->flash('message', 'User created successfully.');
        $this->closeDrawer();
    }

    // Handle user update.
    public function updateUser()
    {
        $this->validateUserData();

        $user = User::findOrFail($this->editingUserId);

        $user->update($this->prepareUserData(true));

        session()->flash('message', 'User updated successfully.');
        $this->closeDrawer();
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