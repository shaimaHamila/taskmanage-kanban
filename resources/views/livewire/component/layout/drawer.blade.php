<div>
    @if ($isDrawerOpen)
        <div
            class="fixed inset-0 bg-black/50 z-[999] transition-opacity duration-300 ease-in-out {{ $isDrawerOpen ? 'opacity-100' : 'opacity-0' }}">
            <div class="absolute top-0 right-0 w-full sm:w-1/2 h-screen bg-white shadow-2xl flex flex-col rounded-l-xl transition-transform duration-300 ease-in-out {{ $isDrawerOpen ? 'translate-x-0' : 'translate-x-full' }}"
                aria-labelledby="drawer-title" role="dialog" aria-modal="true">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h2 id="drawer-title" class="text-xl font-medium text-gray-800">
                        {{ $drawerTitle }}
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
                    {!! $drawerContent !!} <!-- Dynamically rendered content -->
                </div>
            </div>
        </div>
    @endif
</div>
