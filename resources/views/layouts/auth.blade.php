<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'ElderGuard Monitoring')</title>

    {{-- CSS & JS --}}
    @vite(['resources/css/login.css', 'resources/js/login.js'])

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    @stack('styles')

</head>

<body>

    {{-- Background Decoration --}}
    <div class="background-shape shape-1"></div>
    <div class="background-shape shape-2"></div>

    {{-- Content --}}
    @yield('content')

    @stack('scripts')

</body>

</html>
