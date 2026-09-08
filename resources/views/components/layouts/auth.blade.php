<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Login Admin' }} - SIM Masjid Al-Firdaus</title>
    
    <!-- Vite Assets (Sesuaikan dengan setup Laravel Anda) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-gray-900">
    
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>

</body>
</html>