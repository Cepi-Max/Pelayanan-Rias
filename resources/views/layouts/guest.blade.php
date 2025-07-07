<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4">
        <!-- Header/Logo Section -->
        <div class="mb-8 text-center">
            <div class="flex items-center justify-center mb-4">
                <div class="bg-blue-500 p-4 rounded-full shadow-lg">
                    <i class="fas fa-file-contract text-white text-2xl"></i>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Sistem Pengajuan Surat</h1>
            <p class="text-gray-600">Kelola pengajuan surat dengan mudah dan efisien</p>
        </div>

        <!-- Main Content Card -->
        <div class="w-full max-w-md">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border-t-4 border-blue-500">
                <div class="px-8 py-6">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </p>
        </div>

        <!-- Background Decoration -->
        <div class="fixed top-0 left-0 w-full h-full pointer-events-none overflow-hidden z-0">
            <div class="absolute top-10 left-10 w-20 h-20 bg-blue-200 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute top-1/4 right-16 w-16 h-16 bg-indigo-200 rounded-full opacity-30 animate-pulse delay-1000"></div>
            <div class="absolute bottom-1/4 left-1/4 w-12 h-12 bg-purple-200 rounded-full opacity-25 animate-pulse delay-2000"></div>
            <div class="absolute bottom-16 right-1/3 w-24 h-24 bg-blue-100 rounded-full opacity-20 animate-pulse delay-3000"></div>
        </div>
    </div>
</body>
</html>