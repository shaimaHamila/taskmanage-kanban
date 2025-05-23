<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Page Title' }}</title>
    <livewire:styles />
</head>

<body class="h-full bg-gray-50">
    @auth
        <livewire:component.layout.sidebar />
        <div class="md:pl-64 flex flex-col flex-1 h-[calc(100vh-64px)]">
            <livewire:component.layout.navbar />
            <div class="h-full">
                <div class="py-4 h-full">
                    <div class="px-4 h-full">
                        <div class="bg-white rounded-lg h-full p-6">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @else
        {{ $slot }} {{-- for login page --}}
    @endauth

    <livewire:scripts />

    <!-- External Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ✅ Correct order: Alpine core first, then plugin -->
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script> --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.14.8/dist/cdn.min.js"></script>
</body>

</html>
