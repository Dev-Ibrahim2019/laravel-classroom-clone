<!DOCTYPE html>
<html>

<head>
    <title>Classroom</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body>
    <header>
        <x-layout.nav />
    </header>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
</body>

</html>
