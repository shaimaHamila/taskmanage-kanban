<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>{{ $title ?? 'Page Title' }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <livewire:styles />
</head>

<body class="h-full">
    @auth
        <div>
            <livewire:component.layout.sidebar />
            <div class="md:pl-64 flex flex-col flex-1">
                <main class="flex-1">
                    <div class="py-6">

                        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Replace with your content -->
                            <div class="py-4">
                                <div class="border-4 border-dashed border-gray-200 rounded-lg h-96">
                                    {{ $slot }}
                                </div>
                            </div>
                            <!-- /End replace -->
                        </div>
                    </div>
                </main>
            </div>
        </div>
    @else
        {{ $slot }} {{-- for login page --}}
    @endauth

    <livewire:scripts />
</body>

</html>
