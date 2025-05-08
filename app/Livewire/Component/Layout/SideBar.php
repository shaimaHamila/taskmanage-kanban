<?php

namespace App\Livewire\Component\Layout;

use Livewire\Component;

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
    public function render()
    {
        return view('livewire.component.layout.sidebar');
    }
}
