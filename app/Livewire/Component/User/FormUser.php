<?php

namespace App\Livewire\Component\User;

use App\Models\User;
use App\Livewire\Forms\UserType;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\On;

class FormUser extends Component
{
    public UserType $form;
    public $editingUserId = null;
    public $isDrawerOpen = false;  // Drawer is initially closed.

    protected $listeners = ['openUserForm'];

    #[On('open-user-form')]
    public function openUserForm($userId = null)
    {
        // Reset the error bag and form fields before loading user data.
        $this->resetErrorBag();
        $this->form->reset();

        // If editing an existing user, load the data.
        if ($userId) {
            $user = User::findOrFail($userId);
            $this->form->fill($user);
            $this->editingUserId = $user->id;
        } else {
            // Prepare for creating a new user.
            $this->editingUserId = null;
        }

        $this->isDrawerOpen = true;  // Open the drawer.
    }

    // Handle user creation.
    public function addUser()
    {
        $this->validateUserData();

        // Create the new user.
        User::create($this->prepareUserData());

        session()->flash('message', 'User created successfully.');
        $this->closeDrawer();
    }

    // Handle user update.
    public function updateUser()
    {
        $this->validateUserData();

        $user = User::findOrFail($this->editingUserId);

        // Update the user data.
        $user->update($this->prepareUserData(true));

        session()->flash('message', 'User updated successfully.');
        $this->closeDrawer();
    }

    // Prepare the user data (handle password hashing).
    private function prepareUserData($updating = false)
    {
        $userData = [
            'firstName' => $this->form->firstName,
            'lastName' => $this->form->lastName,
            'email' => $this->form->email,
            'role_id' => $this->form->role_id,
        ];

        // If updating, only hash password if provided.
        if (!$updating || !empty($this->form->password)) {
            $userData['password'] = Hash::make($this->form->password);
        }

        return $userData;
    }

    // Validate user data.
    private function validateUserData()
    {
        $this->form->validate();
    }

    // Close the drawer.
    public function closeDrawer()
    {
        $this->isDrawerOpen = false;
        $this->form->reset();
        $this->editingUserId = null;
    }

    public function render()
    {
        return view('livewire.component.user.form-user');
    }
}
