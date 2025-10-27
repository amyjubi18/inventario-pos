@props([
    'title' => config('app.name', 'Laravel'),
    'breadcrumbs' => []
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />




        {{-- Fontawesome --}}
        <script src="https://kit.fontawesome.com/6be0f5c987.js" crossorigin="anonymous"></script>

        {{-- SweetAlert --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Wireui --}}
        <wireui:scripts />

        {{-- ApexCharts CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!-- Scripts -->
        @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])

        {{-- Theme Script --}}
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (!localStorage.getItem('color-theme')) {
                localStorage.setItem('color-theme', 'light');
            }
            if (localStorage.getItem('color-theme') === 'dark') {

            document.addEventListener('DOMContentLoaded', function() {
                const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
                const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
                const themeToggleBtn = document.getElementById('theme-toggle');

                // Function to set the theme and update icons
                function applyTheme() {
                    const userTheme = localStorage.getItem('color-theme');
                    if (userTheme === 'dark') {
                        // Dark mode: show moon, hide sun
                        if (themeToggleLightIcon) themeToggleLightIcon.classList.add('hidden');
                        if (themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
                        document.documentElement.classList.add('dark');
                    } else {
                        // Light mode: show sun, hide moon
                        if (themeToggleDarkIcon) themeToggleDarkIcon.classList.add('hidden');
                        if (themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
                        document.documentElement.classList.remove('dark');
                    }
                }

                // Apply the theme on initial load
                applyTheme();

                if (themeToggleBtn) {
                    themeToggleBtn.addEventListener('click', function() {
                        // Toggle theme
                        const current = localStorage.getItem('color-theme');
                        if (current === 'dark') {
                            localStorage.setItem('color-theme', 'light');
                        } else {
                            localStorage.setItem('color-theme', 'dark');
                        }
                        applyTheme();
                    });
                }
            });
        </script>


        <!-- Styles -->
        @livewireStyles
        @stack('css')
    </head>
    <body class="font-sans antialiased dark:bg-gray-700">

@include('layouts.includes.admin.navigation')
@include('layouts.includes.admin.sidebar')




<div class="h-full p-4 bg-gray-50 sm:ml-64 dark:bg-gray-500">
   <div class="flex items-center mt-14">
        @include('layouts.includes.admin.breadcrumb')
        @isset($action)
        <div class="ml-auto">
            {{ $action }}
        </div>

        @endisset
   </div>



   {{ $slot }}
</div>


        @stack('modals')

        @livewireScripts
            <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

            <script>
                Livewire.on('swal', (data) => {
                    Swal.fire(data[0]);
                })
            </script>

            @if (session('swal'))
            <script>
                Swal.fire(@json(session('swal')));
            </script>
            @endif

    <script>
        forms = document.querySelectorAll('.delete-form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                //alert('Se detuvo el envio del formulario');
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podras revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });

    </script>

            @stack('js')
    </body>
</html>
