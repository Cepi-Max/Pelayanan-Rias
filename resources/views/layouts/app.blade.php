<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- vite gk bisa --}}
     <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen">
    <!-- Navbar -->
    <header>
        @include('layouts.navbar')
    </header>

    <!-- Main Content -->
    <main class="mx-auto w-[90%] pt-[6.5rem] md:pt-[7rem] flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        @include('layouts.footer')
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>


</html>
