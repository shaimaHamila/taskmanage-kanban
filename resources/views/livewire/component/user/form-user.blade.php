<div x-show="isDrawerOpen" class="fixed inset-0 bg-black bg-opacity-50 z-50">
    <div x-show="isDrawerOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        class="absolute top-0 right-0 w-1/3 bg-white p-4">

        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label for="first_name" class="block">First Name</label>
                <input type="text" wire:model="form.first_name" id="first_name"
                    class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div>
                <label for="last_name" class="block">Last Name</label>
                <input type="text" wire:model="form.last_name" id="last_name"
                    class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div>
                <label for="email" class="block">Email</label>
                <input type="email" wire:model="form.email" id="email"
                    class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div>
                <label for="password" class="block">Password</label>
                <input type="password" wire:model="form.password" id="password"
                    class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="flex justify-between">
                <button type="button" @click="isDrawerOpen = false"
                    class="px-4 py-2 bg-gray-300 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                    {{ $editingUserId ? 'Update User' : 'Add User' }}
                </button>
            </div>
        </form>
    </div>
</div>
