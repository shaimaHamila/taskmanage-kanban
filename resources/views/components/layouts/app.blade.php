<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Page Title' }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <livewire:styles />
</head>

<body class="h-full bg-gray-50">
    @auth
        {{-- <div class="h-full"> --}}

        {{-- <div class="md:pl-64 flex flex-col flex-1 h-full">
                <div class="max-w-7xl px-4 sm:px-4 md:px-6 py-2 h-full">
                    <!-- Replace with your content -->
                    <div class="py-4 h-full">
                        <div class=" bg-white rounded-lg h-full p-6">
                            {{ $slot }}
                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </div> --}}
        {{-- </div> --}}

        <livewire:component.layout.sidebar />
        <div class="md:pl-64 flex flex-col flex-1 h-full">

            <livewire:component.layout.navbar />

            <div class="h-full">
                <div class="py-4 h-full">
                    <div class=" px-4 h-full">
                        <!-- Replace with your content -->
                        <div class=" bg-white rounded-lg h-full p-6">
                            {{ $slot }}
                        </div>
                        <!-- /End replace -->
                    </div>
                </div>
            </div>
        </div>
    @else
        {{ $slot }} {{-- for login page --}}
    @endauth

    <livewire:scripts />
</body>
<script type="module"></script>

</html>
