<div>
    @if ($isDrawerOpen && $task)
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
                        Task details
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
                <div class="flex-1 overflow-y-auto px-6 py-5 space-y-6 text-sm text-gray-700">
                    <!-- Task Title -->
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Title</h3>
                        <p class="bg-gray-50 p-3 rounded-md">{{ $task->title }}</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Description</h3>
                        <p class="bg-gray-50 p-3 rounded-md min-h-[80px]">
                            {{ $task->description ?? 'No description provided.' }}
                        </p>
                    </div>

                    <!-- Status -->
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Status</h3>
                        <span
                            class="inline-block px-3 py-1 text-xs rounded-full bg-{{ $statuses[$task->status]['color'] ?? 'gray' }}-100 text-{{ $statuses[$task->status]['color'] ?? 'gray' }}-800 font-medium">
                            {{ $task->status }}
                        </span>
                    </div>

                    <!-- Assigned User -->
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Assigned to</h3>
                        @if ($task->user)
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full bg-gray-300"
                                    style="background-image: url('https://i.pravatar.cc/150?u={{ $task->user->id }}'); background-size: cover; background-position: center;">
                                </div>
                                <span>{{ $task->user->firstName }} {{ $task->user->lastName }}</span>
                            </div>
                        @else
                            <span class="text-gray-500 italic">Not assigned</span>
                        @endif
                    </div>

                    <!-- Created At -->
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Created at</h3>
                        <p>{{ $task->created_at?->format('F d, Y \a\t h:i A') ?? 'N/A' }}</p>
                    </div>

                    <!-- Updated At -->
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Last updated</h3>
                        <p>{{ $task->updated_at?->format('F d, Y \a\t h:i A') ?? 'N/A' }}</p>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
