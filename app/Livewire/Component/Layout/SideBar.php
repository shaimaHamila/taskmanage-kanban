<?php

namespace App\Livewire\Component\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SideBar extends Component
{
    public $sidebarOpen = false;
    public $navLinks;

    public function mount()
    {
        $userRole = Auth::user() ? Auth::user()->role->roleName : null;

        $filteredLinks = config('menu.common', []);

        if ($userRole && config("menu.$userRole")) {
            $filteredLinks = array_merge($filteredLinks, config("menu.$userRole"));
        }

        $this->navLinks = $filteredLinks;
    }
    protected $listeners = [
        'toggleSidebar' => 'toggleSidebar',
    ];
    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
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
