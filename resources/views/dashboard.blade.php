<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="icon" href="{{ asset('awinet.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>


<body class="overflow-hidden">
    <header class="bg-black/80 w-full h-14 flex items-center justify-between px-8">
        <img src="{{ asset('awinet.png') }}" alt="Company Logo" class="h-8 w-auto">
        <nav>
            <button class="lg:hidden text-lg font-bold bg-gray-200 px-4 py-2 rounded-md text-black/80 cursor-pointer">
                Menu
            </button>
            <button
                class="hidden lg:block p-1 rounded-full bg-white pointer-cursor hover:bg-gray-300 focus:outline-none focus:ring focus:ring-gray-200 cursor-pointer">
                <svg class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

            </button>
            {{-- <ul class="hidden lg:flex items-center gap-4">
                <li><a href="#" class="text-white hover:text-gray-300">Home</a></li>
                <li><a href="#" class="text-white hover:text-gray-300">Profile</a></li>
                <li><a href="#" class="text-white hover:text-gray-300">Settings</a></li>
                <li><a href="#" class="text-white hover:text-gray-300">Logout</a></li>
            </ul> --}}
        </nav>

    </header>
    <div class="flex h-screen overflow-hidden">
        <aside class="hidden lg:block bg-[#007E41] w-56 min-h-screen pl-2 pt-2 pr-4">
            <ul class="flex flex-col h-[90%]">
                <li><a href="#"
                        class="text-sm block px-4 py-2 rounded-full hover:bg-[#F14F10] hover:text-white hover:shadow-xl">Dashboard</a>
                </li>
                <li><a href="#"
                        class="text-sm block px-4 py-2 rounded-full hover:bg-[#F14F10] hover:text-white hover:shadow-xl">Profile</a>
                </li>
                <li><a href="#"
                        class="text-sm block px-4 py-2 rounded-full hover:bg-[#F14F10] hover:text-white hover:shadow-xl">Settings</a>
                </li>
                <li class="mt-auto"><a href="#"
                        class="text-sm block px-4 py-2 rounded-full hover:bg-[#F14F10] hover:text-white hover:shadow-xl">Logout</a>
                </li>
            </ul>
        </aside>
        <main class="flex-1 overflow-y-auto p-4 flex flex-col">
            <div class="flex-1 flex-col p-4">
                <h1 class="text-4xl font-bold text-gray-800">Welcome to the Dashboard</h1>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold text-gray-800">Card 1</h2>
                        <p class="mt-4 text-gray-600">This is the content of card 1.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold text-gray-800">Card 2</h2>
                        <p class="mt-4 text-gray-600">This is the content of card 2.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold text-gray-800">Card 3</h2>
                        <p class="mt-4 text-gray-600">This is the content of card 3.</p>
                    </div>
                </div>
            </div>
            <footer class="mb-[5%]">
                <p class="text-center text-gray-500 text-sm mt-4">© 2026 Awinet. All rights reserved.</p>
            </footer>
        </main>
    </div>
</body>

</html>
