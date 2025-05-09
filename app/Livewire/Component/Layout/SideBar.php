<?php

namespace App\Livewire\Component\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SideBar extends Component
{
    public $sidebarOpen = false;

    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
    }
    public function selectComponent($component)
    {
        $this->dispatch('componentSelected', component: $component);
    }
    public function handleLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.component.layout.sidebar');
    }
}
