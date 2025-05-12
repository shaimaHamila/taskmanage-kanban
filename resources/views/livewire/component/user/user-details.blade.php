<div>
    @if ($isDrawerOpen && $user)
        <!-- Backdrop -->

        <div class="fixed inset-0 bg-black/50 z-[998] transition-opacity duration-100 ease-in-out">
            <!-- Drawer -->
            <div class="fixed top-0 right-0 w-full sm:w-1/2 h-screen bg-white shadow-2xl flex flex-col rounded-l-xl z-[999]
                   transform transition-transform duration-100 ease-in-out
                   {{ $isDrawerOpen ? 'translate-x-0' : 'translate-x-full' }}"
                aria-labelledby="drawer-title" role="dialog" aria-modal="true">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h2 id="drawer-title" class="text-xl font-medium text-gray-800">
                        View User details
                    </h2>
                    <button wire:click="closeDrawer"
                        class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-red-500 hover:bg-gray-100 rounded-full transition duration-150 cursor-pointer"
                        aria-label="Close drawer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="flex-1 overflow-y-auto px-6 py-5">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full border-4 border-indigo-500 avatar mb-6"
                            style="background-image: url('https://i.pravatar.cc/150?u={{ $user->id }}'); background-size: cover; background-position: center;">
                        </div>

                        <h3 class="text-2xl font-bold text-gray-800 mb-4">User Details</h3>
                        <div class="w-full space-y-4">
                            <p class="flex justify-between text-gray-600">
                                <span class="font-semibold">First Name:</span>
                                <span>{{ $user->firstName }}</span>
                            </p>
                            <p class="flex justify-between text-gray-600">
                                <span class="font-semibold">Last Name:</span>
                                <span>{{ $user->lastName }}</span>
                            </p>
                            <p class="flex justify-between text-gray-600">
                                <span class="font-semibold">Email:</span>
                                <span>{{ $user->email }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
