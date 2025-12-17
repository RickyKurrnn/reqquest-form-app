<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Form Request' }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('partials.styles')

    @stack('styles')
</head>

<body class="bg-light">

    <div class="app-layout">

        @include('partials.sidebar')

        <main class="main-content">

            <button id="sidebarToggle" class="sidebar-toggle">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="container-fluid py-4">
                @yield('content')
            </div>
        </main>

    </div>

    @include('partials.scripts')

    @stack('scripts')

</body>

</html>
