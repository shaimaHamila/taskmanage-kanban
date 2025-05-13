<div>
    @if ($isDrawerOpen)
        <div
            class="fixed inset-0 bg-black/50 z-[999] transition-opacity duration-300 ease-in-out {{ $isDrawerOpen ? 'opacity-100' : 'opacity-0' }}">
            <div class="absolute top-0 right-0 w-full sm:w-1/2 h-screen bg-white shadow-2xl flex flex-col rounded-l-xl transition-transform duration-300 ease-in-out {{ $isDrawerOpen ? 'translate-x-0' : 'translate-x-full' }}"
                aria-labelledby="drawer-title" role="dialog" aria-modal="true">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h2 id="drawer-title" class="text-xl font-medium text-gray-800">Update Task</h2>
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
                    <form wire:submit.prevent="saveTask" class="space-y-5">
                        <div>
                            <label for="task.title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" wire:model="task.title" id="task.title" placeholder="Enter task title"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-300 text-sm">
                            @error('task.title')
                                <p class="text-red-500 text-xs mt-2">{{ $errors->first('task.title') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="task.description"
                                class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea wire:model="task.description" id="task.description" placeholder="Enter task description"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-300 text-sm"></textarea>
                            @error('task.description')
                                <p class="text-red-500 text-xs mt-2">{{ $errors->first('task.description') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="task.status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select wire:model="task.status" id="task.status"
                                class="mt-1 block w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300">
                                <option value="">Select status</option>
                                @foreach ($taskStatus::values() as $status)
                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @error('task.status')
                                <p class="text-red-500 text-xs mt-2">{{ $errors->first('task.status') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="task.user_id" class="block text-sm font-medium text-gray-700">Assigned
                                User</label>
                            <select wire:model="task.user_id" id="task.user_id"
                                class="mt-1 block w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300">
                                <option value="">Select user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->firstName }}</option>
                                @endforeach
                            </select>
                            @error('task.user_id')
                                <p class="text-red-500 text-xs mt-2">{{ $errors->first('task.user_id') }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                            <button type="button" wire:click="closeDrawer"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition cursor-pointer text-sm">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition cursor-pointer text-sm">
                                Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
