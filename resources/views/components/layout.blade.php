<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="w-[100%] h-[70px] bg-orange text-white px-[50px] flex justify-between items-center">
        <div class="flex">
            <p class="mr-[50px]">{{ Auth::user()->name }}</p>
            <p>{{ Auth::user()->role }}</p>
        </div>

        <a href="{{ route('login.destroy') }}">Sair</a>
    </div>
    
    {{ $slot }}
</body>
</html>