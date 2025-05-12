<div class="overflow-x-auto border-1 border-gray-200 rounded-lg  p-4 h-full">
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
            <div class="w-60 flex-shrink-0 bg-gray-50 rounded-xs shadow-xs p-3">
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

                <!-- Add Task Button (only in To Do) -->

                <div class="mb-4">
                    <div class="flex flex-row items-center text-gray-300 mt-2 px-1">
                        <p class="rounded mr-2 text-2xl">+</p>
                        <p class="pt-1 rounded text-sm">New</p>
                    </div>
                </div>

                <!-- Task Cards -->
                <div class="space-y-3">
                    @foreach ($tasks->where('status', $key) as $task)
                        <div
                            class="border border-{{ $meta['color'] }}-200 rounded-lg p-3 shadow-sm hover:shadow-md transition duration-150 ease-in-out">
                            <h3 class="text-md font-medium text-gray-800">{{ $task->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-3">{{ $task->description }}</p>
                            <div class="text-xs text-gray-400 mt-2 flex justify-between">
                                <span>By: {{ $task->user->name ?? 'Unknown' }}</span>
                                <span>{{ $task->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
