<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GMAO Trans\'urb')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background: #eafaf4; min-height: 100vh; }
        .header-bg { background: #17423b; color: #fff; padding-bottom: 40px; box-shadow: 0 2px 8px rgba(23,66,59,0.08); }
        .main-navbar { display: flex; align-items: center; justify-content: space-between; padding: 0 2.5rem; height: 64px; }
        .main-content { max-width: 1200px; margin: 0 auto; margin-top: -30px; margin-bottom: 2.5rem; z-index: 20; position: relative; }
    </style>
</head>
<body>
    <div class="header-bg">
        <nav class="main-navbar">
            <span class="text-xl font-bold tracking-wide">Trans'urb GMAO</span>
        </nav>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html> 