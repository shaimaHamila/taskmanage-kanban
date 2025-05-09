<!-- resources/views/user-list.blade.php -->

<div>
    <div class="container mx-auto">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">User Management</h1>
            <!-- Add User Button -->
            <button wire:click.prevent="dispatch('open-user-form')"
                class="cursor-pointer px-5 py-1.5 bg-blue-600 text-white rounded-md  hover:bg-blue-700 transition-all duration-300 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add User
            </button>
        </div>

        <!-- User Table -->
        <div class="bg-white shadow-xs rounded-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 tracking-wider">First Name
                            </th>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 tracking-wider">Last Name
                            </th>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 tracking-wider">Email</th>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-700 tracking-wider">Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-4 px-6 text-sm text-gray-900">{{ $user->firstName }}</td>
                                <td class="py-4 px-6 text-sm text-gray-900">{{ $user->lastName }}</td>
                                <td class="py-4 px-6 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="py-4 px-6 text-sm">
                                    <div class="flex space-x-2">
                                        <!-- View Button -->
                                        <button wire:click.prevent="openUserDetails({{ $user->id }})"
                                            class="cursor-pointer px-4 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-all duration-300 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>
                                        <!-- Edit Button -->
                                        <button wire:click.prevent="updateUserHandler({{ $user->id }})"
                                            class="cursor-pointer px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-all duration-300 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>

                                        <!-- Delete Button -->
                                        <button wire:click="deleteUser({{ $user->id }})"
                                            class="cursor-pointer px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-all duration-300 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Drawer for Add/Edit User -->
    <livewire:component.user.form-user />
    <!-- Drawer Component -->
    <livewire:component.layout.drawer />
</div>
