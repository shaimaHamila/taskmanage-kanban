<div class="overflow-x-auto scrollbar-custom border-1 rounded-lg p-4 h-full" style="border-color: #bc9d20d7;">
    <div class="flex space-x-4 min-w-fit h-full">
        @php
            $statuses = [
                'TODO' => ['label' => 'TODO', 'color' => 'gray'],
                'IN_PROGRESS' => ['label' => 'IN PROGRESS', 'color' => 'blue'],
                'IN_REVIEW' => ['label' => 'IN REVIEW', 'color' => 'yellow'],
                'DONE' => ['label' => 'DONE', 'color' => 'green'],
                'CANCELLED' => ['label' => 'CANCELLED', 'color' => 'red'],
            ];
        @endphp

        @foreach ($statuses as $key => $meta)
            <div class="w-60 bg-gray-50 rounded-xs shadow-inner p-0.5 flex flex-col">
                <!-- Column Header -->
                <div class="flex justify-between items-center p-1">
                    <div class="flex gap-1 items-center">
                        <h2
                            class="text-xs py-1 px-1.5 rounded-md bg-{{ $meta['color'] }}-100 font-semibold text-gray-700">
                            {{ $meta['label'] }}
                        </h2>
                        <h2 class="text-xs text-gray-500 px-2 py-1 rounded-full font-medium ">
                            {{ $tasks->where('status', $key)->count() }}
                        </h2>
                    </div>
                    @if (Auth::user()->role->roleName === 'admin')
                        <button wire:click="handleShowNewTaskInput('{{ $key }}')"
                            class="flex text-xl cursor-pointer items-center rounded hover:bg-[#bc9d201d] text-gray-500 pb-1 px-2  ">
                            +
                        </button>
                    @endif


                </div>

                <!-- Scrollable Task Area -->
                <div class="bg-gray-50 rounded-xs px-1 overflow-y-auto h-[calc(100vh-200px)] flex-1 scrollbar-custom">
                    <!-- Task Cards -->
                    <div x-data x-sort
                        x-on:sorted.window="$wire.updateTaskOrder('{{ $key }}', $event.detail.map(item => item.id))"
                        class="space-y-2 mt-1">
                        @foreach ($tasks->where('status', $key) as $task)
                            <div wire:key="{{ $task->id }}" x-sort:item="{{ $task->id }}"
                                class="p-2 cursor-pointer rounded  border-2 bg-white"
                                wire:click="handleTaskDetails('{{ $task->id }}')" style="border-color: #bc9d2031;">
                                <!-- Task Content -->
                                <div class="flex justify-between items-start">
                                    <h3 class="text-sm mb-3 text-gray-700 font-medium truncate max-w-[75%]">
                                        {{ $task->title }}
                                    </h3>
                                    @if (Auth::user()->role->roleName === 'admin')
                                        <div class="flex items-center space-x-1">
                                            <button title="Edit"
                                                wire:click.stop="handleTaskUpdate({{ $task->id }})"
                                                class="p-1 rounded-full cursor-pointer text-gray-400 hover:text-blue-400 hover:bg-blue-100 transition-all">
                                                <x-heroicon-o-pencil-square class="h-4.5 w-4.5" />
                                            </button>
                                            <button title="Delete" wire:click="deleteTask({{ $task->id }})"
                                                class="p-1 rounded-full cursor-pointer text-gray-400 hover:text-rose-400 hover:bg-rose-100 transition-all">
                                                <x-heroicon-o-trash class="h-4.5 w-4.5" />
                                            </button>
                                        </div>
                                    @endif
                                </div>

                                @if ($task->user)
                                    <div class="flex flex-row items-center ">
                                        <div class="bg-gray-300 rounded-full w-4 h-4 mr-1"
                                            style="background-image: url('https://i.pravatar.cc/150?u={{ $task->user->id }}'); background-size: cover; background-position: center;">
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            {{ $task->user->firstName }} {{ $task->user->lastName }}
                                        </p>
                                    </div>
                                @else
                                    <div class="flex flex-row items-center ">
                                        <p class="text-xs text-gray-500">
                                            Not assigned
                                        </p>
                                    </div>
                                @endif
                                <p class="text-xs text-gray-500 mt-3">
                                    Created At: {{ $task->created_at?->format('M d, Y') ?? 'N/A' }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Task Button -->
                    @if (Auth::user()->role->roleName === 'admin')
                        <div class="mb-4 mt-2">
                            @if ($showNewTaskInput === $key)
                                <input type="text" wire:model.defer="newTask.title"
                                    wire:keydown.enter="createTask('{{ $key }}')"
                                    class="w-full border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-300 px-2 py-1 text-sm"
                                    placeholder="Enter task title..." autofocus />
                            @else
                                <button wire:click="handleShowNewTaskInput('{{ $key }}')"
                                    class="flex cursor-pointer items-center rounded hover:bg-[#bc9d201d] text-gray-400 pb-1 px-2 w-full">
                                    <span class="text-2xl mr-2">+</span>
                                    <span class="text-sm pt-1">New</span>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <livewire:component.task.form-task />
    <livewire:component.task.task-details />
    <style>
        /* Target scrollable area */
        .scrollbar-custom::-webkit-scrollbar {
            width: 5px;
            height: 8px;
            /* thinner scrollbar */
        }

        .scrollbar-custom::-webkit-scrollbar-thumb {
            background-color: rgba(128, 128, 128, 0.299);
            /* light golden like your theme */
            border-radius: 4px;
        }

        .scrollbar-custom::-webkit-scrollbar-track {
            background-color: #f5f5f5;
        }
    </style>

</div>
