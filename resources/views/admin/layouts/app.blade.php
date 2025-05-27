<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>

<body class="bg-gray-100 font-sans h-screen flex flex-col">

    <!-- Navbar -->
    @include('admin.layouts.navbar')

    <!-- Layout -->
    <div class="flex flex-1 pt-16">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-6 bg-gray-50 min-h-screen">
            @yield('content')
        </main>
    </div>
    <!-- notifikasi mengambang -->
    @include('admin.layouts.notifikasi')

</body>

</html>
