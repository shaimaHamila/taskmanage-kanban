<div>
    @if ($sidebarOpen)
        <div class="fixed inset-0 flex z-50 md:hidden" role="dialog" aria-modal="true">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-black/60 transition-opacity duration-300 ease-in-out" aria-hidden="true"></div>

            <!-- Mobile sidebar -->
            <div
                class="relative flex flex-col w-full max-w-xs bg-white transform transition-transform duration-300 ease-in-out">
                <!-- Close button -->
                <div class="absolute top-4 right-4">
                    <button wire:click="toggleSidebar" type="button"
                        class="p-2 rounded-full text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Sidebar content -->
                <div class="flex flex-col h-full pt-8 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-6">
                        <img class="h-10 w-50" src="/svg/logo.svg" alt="Logo">
                    </div>

                    <nav class="flex-1 mt-8 px-4 space-y-2">


                        @foreach ($navLinks as $link)
                            <a href="{{ route($link['route']) }}" @class([
                                'group flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-colors duration-200',
                                'bg-blue-100 text-blue-700' => request()->routeIs($link['route']),
                                'text-gray-700 hover:bg-blue-50 hover:text-blue-600' => !request()->routeIs(
                                    $link['route']),
                            ])>
                                {{-- <p> Add Icon here </p> --}}
                                {{ $link['title'] }}
                            </a>
                            <hr class="border-gray-100">
                        @endforeach
                    </nav>

                    <!-- Logout button -->
                    <div class="flex-shrink-0 border-t border-gray-100 p-4">
                        <a href="{{ route('login') }}"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors duration-200">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-shrink-0 w-14"></div>
        </div>
    @endif

    <!-- Desktop sidebar -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
        <div class="flex flex-col flex-grow border-r border-gray-100 pt-5  bg-white overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <img class="h-10 w-auto" src="/svg/logo.svg" alt="Logo">
            </div>

            <div class="mt-16 flex-grow flex flex-col">
                <nav class="flex-1 px-2 pb-4 space-y-1">
                    @foreach ($navLinks as $link)
                        <a href="{{ route($link['route']) }}" @class([
                            'group flex items-center px-4 py-3 rounded-lg font-medium transition-colors duration-200',
                            'bg-blue-100 text-blue-700' => request()->routeIs($link['route']),
                            'text-gray-700 hover:bg-blue-50 hover:text-blue-600' => !request()->routeIs(
                                $link['route']),
                        ])>
                            {{-- <p> Icon </p> --}}
                            {{ $link['title'] }}
                        </a>
                        <hr class="border-gray-100">
                    @endforeach
                </nav>
            </div>
            <!-- Logout -->
            <div class="flex-shrink-0 flex border-t border-gray-100 p-4">
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
</div>
