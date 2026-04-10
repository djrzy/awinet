<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="icon" href="{{ asset('awinet.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-hidden relative font-default">
    @include('partials.navbar')

    <div class="flex h-screen overflow-hidden">
        @include('partials.sidebar')
        <main>
            <div class="px-6 pt-6 pb-20">
                @yield('content')
            </div>
            @include('partials.footer')
        </main>
    </div>
</body>

</html>
