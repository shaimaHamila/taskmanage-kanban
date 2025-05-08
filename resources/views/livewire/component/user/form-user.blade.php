<div>
    @if ($isDrawerOpen)
        <div class="fixed inset-0 bg-black/50 z-[999]">
            <!-- Drawer -->
            <div
                class="absolute top-0 right-0 w-full sm:w-1/2 h-screen bg-white shadow-2xl flex flex-col rounded-l-xl transition-transform duration-300 ease-in-out translate-x-0">
                <!-- Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-medium text-gray-800">
                        {{ $editingUserId ? 'Edit User' : 'Add new User' }}
                    </h2>
                    <button wire:click="closeDrawer"
                        class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-red-500 hover:bg-gray-100 rounded-full transition duration-150 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="flex-1 overflow-y-auto px-6 py-5">
                    <form wire:submit.prevent="{{ $editingUserId ? 'updateUser' : 'addUser' }}" class="space-y-5">
                        <div class="mb-4">
                            <label for="role_id" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="role_id" wire:model="user.role_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md"
                                {{ $editingUserId ? 'disabled' : '' }}>
                                <option value="" disabled>Select user Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $role->id == $user->role_id ? 'selected' : '' }}>
                                        {{ $role->roleName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First
                                Name</label>
                            <input type="text" wire:model="user.firstName" id="first_name"
                                placeholder="Enter first name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-300 text-sm">
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last
                                Name</label>
                            <input type="text" wire:model="user.lastName" id="last_name"
                                placeholder="Enter last name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-300 text-sm">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" wire:model="user.email" id="email" placeholder="example@email.com"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-300 text-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="password" wire:model="user.password" id="password"
                                placeholder="Enter password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-300 text-sm">
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                            <button type="button" wire:click="closeDrawer"
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition cursor-pointer text-sm">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition cursor-pointer text-sm">
                                {{ $editingUserId ? 'Update User' : 'Add User' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
