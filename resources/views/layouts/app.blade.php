<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navbar -->
    <header>
        @include('layouts.navbar')
    </header>

    <!-- Main Content -->
    <main class="mx-auto w-[90%] pt-[6.5rem] md:pt-[7rem]">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        @include('layouts.footer')
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>