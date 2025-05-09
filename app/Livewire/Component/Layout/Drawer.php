<?php

namespace App\Livewire\Component\Layout;

use Livewire\Component;
use Livewire\Attributes\On;

class Drawer extends Component
{
    public $drawerTitle = "Title";
    public $drawerContent = '';
    public $isDrawerOpen = false;


    #[On('open-drawer')]
    public function openDrawer($data)
    {
        $this->drawerTitle = $data['drawerTitle'];
        $this->drawerContent = $data['content'];
        $this->isDrawerOpen = true;
    }

    #[On('close-drawer')]
    public function closeDrawer()
    {
        $this->isDrawerOpen = false;
        $this->drawerTitle = "";
        $this->drawerContent = "";
    }
    public function render()
    {
        return view('livewire.component.layout.drawer');
    }
}
