<div>
    <!-- Off-canvas menu for mobile -->
    <div>
        @if ($sidebarOpen)
        <div class="fixed inset-0 flex z-50 md:hidden" role="dialog" aria-modal="true">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black/60 transition-opacity duration-300 ease-in-out" aria-hidden="true">
            </div>

            <!-- Mobile sidebar -->
            <div
                class="relative flex-1 flex flex-col max-w-xs w-full bg-white transform transition-transform duration-300 ease-in-out">
                <!-- Close button -->
                <div class="absolute top-4 right-4">
                    <button wire:click="toggleSidebar" type="button"
                        class="p-2 cursor-pointer rounded-full text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile sidebar content -->
                <div class="flex-1 flex flex-col h-full pt-8  overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-6">
                        <img class="h-10 w-50" src="/svg/logo.svg" alt="Logo">
                    </div>
                    <nav class="mt-8 flex-1 px-4 space-y-2">
                        <!-- Tasks Management -->
                        <a href="{{ route('tasks') }}"
                            class="{{ request()->routeIs('tasks') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} group flex items-center px-4 py-3 rounded-lg transition-colors duration-200 text-sm font-medium">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('tasks') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            Tasks Management
                        </a>

                        <hr class="border-gray-200">

                        <!-- Users Management -->
                        <a href="{{ route('users') }}"
                            class="{{ request()->routeIs('users') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} group flex items-center px-4 py-3 rounded-lg transition-colors duration-200 text-sm font-medium">
                            <svg class="h-5 w-5 mr-3 {{ request()->routeIs('users') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Users Management
                        </a>

                        <hr class="border-gray-200">
                    </nav>

                    <!-- Logout Button - placed at the bottom -->
                    <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                        <a href="{{ route('login') }}"
                            class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors duration-200">
                            <div class="flex items-center space-x-2">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Logout</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-shrink-0 w-14"></div>
        </div>
        @endif
    </div>


    <!-- Desktop sidebar -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 bg-white">
        <div class="flex-1 flex flex-col min-h-0">
            <div class="flex-1 flex flex-col pt-8 pb-4 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-6">
                    <img class="h-16 w-auto" src="/svg/logo.svg" alt="Workflow">
                </div>

                <nav class="mt-8 flex-1 px-4 space-y-2 text-sm">
                    <!-- Tasks Management -->
                    <a href="{{ route('tasks') }}"
                        class="{{ request()->routeIs('tasks') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} group flex items-center px-4 py-3 rounded-lg font-medium transition-colors duration-200">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('tasks') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h彼此

                        <path stroke-linecap=" round" stroke-linejoin="round" stroke-width="2"
                                d=" M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        Tasks Management
                    </a>

                    <hr class="border-gray-200">

                    <!-- Users Management -->
                    <a href="{{ route('users') }}"
                        class="{{ request()->routeIs('users') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }} group flex items-center px-4 py-3 rounded-lg font-medium transition-colors duration-200">
                        <svg class="h-5 w-5 mr-3 {{ request()->routeIs('users') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users Management
                    </a>
                </nav>
            </div>

            <!-- Logout -->
            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                <a wire:click="handleLogout"
                    class="w-full cursor-po flex items-center justify-between px-4 py-3 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors duration-200">
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="md:pl-72 flex flex-col flex-1">
        <div class="sticky top-0 z-10 md:hidden pl-4 pt-2 pb-2 bg-white shadow-sm">
            <button wire:click="toggleSidebar" type="button"
                class="p-2 cursor-pointer rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</div>