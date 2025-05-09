<div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white px-5">
    <button wire:click="toggleSidebar" type="button"
        class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
        <span class="sr-only">Open sidebar</span>
        <!-- Heroicon name: outline/menu-alt-2 -->
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
    </button>

    <div class="flex-1 px-4 flex justify-between items-center">
        <div class="flex-1 flex items-center">
            <div class="w-full flex md:ml-0 items-center">
                <!-- Display the dynamically set page title -->
                <h1 class="text-sm md:text-lg font-semibold text-gray-700">
                    {{ $pageTitle }}
                </h1>
            </div>
        </div>

        <div class="ml-4 flex items-center md:ml-6">
            <h3 class="text-sm font-medium text-gray-900">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}
            </h3>

            <!-- Profile  -->
            <div class="ml-3 relative">
                <div>
                    <button type="button"
                        class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full"
                            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
