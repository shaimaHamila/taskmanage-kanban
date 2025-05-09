<?php

namespace App\Livewire\Component\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class Navbar extends Component
{
    public $navLinks;
    public $pageTitle;

    public function mount()
    {
        $filteredLinks = config('menu.common', []);

        $menu = config('menu');
        foreach ($menu as $category => $routes) {
            $filteredLinks = array_merge($filteredLinks, $routes);
        }

        $this->navLinks = $filteredLinks;

        $this->pageTitle = $this->getPageTitle(Route::currentRouteName());
    }

    /**
     * Get the page title based on the current route name.
     *
     * @param  string  $routeName
     * @return string
     */
    public function getPageTitle($routeName)
    {
        $menu = config('menu');

        foreach ($menu as $category => $routes) {
            foreach ($routes as $route) {
                if ($route['route'] === $routeName) {
                    return $route['title'];
                }
            }
        }

        return 'Page Title'; // Default title if the route isn't found
    }

    public function toggleSidebar()
    {
        $this->dispatch('toggleSidebar');
    }

    public function render()
    {
        return view('livewire.component.layout.navbar');
    }
}
