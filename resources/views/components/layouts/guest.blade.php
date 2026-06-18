<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? "Masjid Al-Firdaus" }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white text-gray-800">

    <x-guest.navbar />

    <main>
        {{ $slot }}
    </main>

    <x-guest.footer />

    @stack('scripts')

</body>

</html>
