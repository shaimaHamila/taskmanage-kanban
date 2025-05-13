<div class="overflow-x-auto border-1 border-gray-200 rounded-lg p-4 h-full">
    <div class="flex space-x-4 min-w-fit h-full">
        @php
            $statuses = [
                'TODO' => ['label' => 'To Do', 'color' => 'gray'],
                'IN_PROGRESS' => ['label' => 'In Progress', 'color' => 'blue'],
                'IN_REVIEW' => ['label' => 'In Review', 'color' => 'yellow'],
                'DONE' => ['label' => 'Done', 'color' => 'green'],
                'CANCELLED' => ['label' => 'Cancelled', 'color' => 'red'],
            ];
        @endphp

        @foreach ($statuses as $key => $meta)
            <div class="w-60 flex-shrink-0 bg-gray-50 rounded-xs shadow-inner p-3">
                <!-- Column Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-md font-semibold text-{{ $meta['color'] }}-600">
                        {{ $meta['label'] }}
                    </h2>
                    <span
                        class="text-xs bg-{{ $meta['color'] }}-100 text-{{ $meta['color'] }}-800 px-2 py-1 rounded-full">
                        {{ $tasks->where('status', $key)->count() }} task(s)
                    </span>
                </div>

                <!-- Add Task Button (for every column) -->
                <div class="mb-4">
                    @if ($showNewTaskInput === $key)
                        <input type="text" wire:model.defer="newTask.title"
                            wire:keydown.enter="createTask('{{ $key }}')"
                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                            placeholder="Enter task title..." autofocus />
                    @else
                        <button wire:click="handleShowNewTaskInput('{{ $key }}')"
                            class="flex cursor-pointer items-center rounded bg-white text-gray-400 pb-1 px-2 w-full">
                            <span class="text-2xl mr-2">+</span>
                            <span class="text-sm pt-1">New</span>
                        </button>
                    @endif
                </div>

                <!-- Task Cards -->
                <div class="space-y-3">
                    @foreach ($tasks->where('status', $key) as $task)
                        <div wire:key="{{ $task->id }}"
                            class="p-2 rounded shadow-sm border-gray-100 border-2 bg-white">
                            {{-- Title and Action Icons --}}
                            <div class="flex justify-between items-start">
                                <h3 class="text-sm mb-3 text-gray-700 font-medium truncate max-w-[75%]">
                                    {{ $task->title }}
                                </h3>
                                @if (Auth::user()->role->roleName === 'admin')
                                    {{-- Action Icons --}}
                                    <div class="flex items-center space-x-1">
                                        {{-- Edit --}}
                                        <button title="Edit"
                                            class="p-1 rounded-full cursor-pointer text-gray-400 hover:text-blue-400 hover:bg-blue-100 transition-all">
                                            <x-heroicon-o-pencil-square class="h-4.5 w-4.5" />
                                        </button>
                                        {{-- Delete --}}
                                        <button title="Delete" wire:click="deleteTask({{ $task->id }})"
                                            class="p-1 rounded-full cursor-pointer text-gray-400 hover:text-rose-400 hover:bg-rose-100 transition-all">
                                            <x-heroicon-o-trash class="h-4.5 w-4.5" />
                                        </button>
                                    </div>
                                @endif
                            </div>

                            {{-- Status --}}
                            <p class="bg-{{ $meta['color'] }}-100 text-xs w-max p-1 rounded mr-2 text-gray-700">
                                {{ $task->status }}
                            </p>

                            {{-- User --}}
                            <div class="flex flex-row items-center mt-2">
                                <div class="bg-gray-300 rounded-full w-4 h-4 mr-1"></div>
                                <p class="text-xs text-gray-500">
                                    {{ $task->user ? $task->user->firstName . ' ' . $task->user->lastName : 'Unknown' }}
                                </p>
                            </div>

                            {{-- Created At --}}
                            <p class="text-xs text-gray-500 mt-3">
                                Created At: {{ $task->created_at?->format('M d, Y') ?? 'N/A' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <livewire:component.task.form-task />
</div>
