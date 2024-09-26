<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="author" content="Devzet LLC">

    <meta name="description" content="">

    <!-- Tailwind -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.0.2/tailwind.min.css" integrity="sha512-1Syxn6SauehFJWEP+FayZmh0iQhCyf0Hmkf1goyhnVRGBTubtBJj8oLroZ/3/Q1uYKYFgWgBBgA1mtFbFl/Ucg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }

        .bg-brand-btn { background: #3d68ff; }
        .bg-brand-btn:hover { background: #1947ee; }
    </style>

    @stack('headerPartial')
</head>
<body class="bg-gray-100 font-family-karla flex">

    @include('layouts.backend-partial.asidebar')

    <div class="w-full flex flex-col h-screen overflow-y-hidden">

        @include('layouts.backend-partial.header')

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                @yield('content')
            </main>

            @include('layouts.backend-partial.footer')

        </div>
    </div>


   <!-- AlpineJS -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js" integrity="sha512-No22QdEJ4zlXvdQDpm6oeXcjwajpNxvnstx6NEU/5qZFysa5gsgj/bSfAFpSc9Za5LjbgQLRXyCeY53aWmk8ZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    @stack('footerPartial')

    <script>
        function onDelete() {
            let alert = confirm('Do you want to delete this data?');
        }
    </script>
</body>
</html>