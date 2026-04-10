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
    {{-- <div class="absolute z-1 backdrop-blur-sm lg:hidden top-12 left-0 h-full bg-[#007E41]/80 w-[75%]">
        test
    </div> --}}
    {{-- <div class="lg:hidden fixed inset-0 z-50 flex items-center justify-center">

        <!-- 1. The Backdrop (This does the blurring) -->
        <div class="fixed inset-0 mt-12 bg-black/40 backdrop-blur-xs"></div>

        <!-- 2. The Modal Box (Stays sharp) -->
        <div class="relative z-10 bg-white p-8 rounded-lg shadow-xl max-w-md">
            <h2 class="text-xl font-bold">Modal Title</h2>
            <p class="mt-2">The background is now blurry!</p>
            <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Close</button>
        </div>

    </div> --}}
    <header>
        <img src="{{ asset('awinet.png') }}" alt="Company Logo" class="h-8 w-auto mx-auto lg:mx-0">
        <div class="flex gap-3">
            <nav>
                <button
                    class="hidden relative lg:flex text-2xl items-center justify-center rounded-full p-1 bg-white pointer-cursor hover:bg-gray-300 focus:outline-none focus:ring focus:ring-gray-200 cursor-pointer">
                    <span class="material-symbols-outlined">
                        notifications
                    </span>
                    <div class="absolute hidden bg-white right-0 top-14 rounded-sm w-36 shadow-md">
                        <ul class="hidden lg:flex flex-col items-start justify-center text-sm">
                            <li class="w-full py-1.5 hover:bg-gray-100">
                                <a href="#" class="px-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined">
                                        home
                                    </span>
                                    Home
                                </a>
                            </li>
                            <li class="w-full py-1.5 hover:bg-gray-100">
                                <a href="#" class="px-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined">
                                        person
                                    </span>
                                    Profile
                                </a>
                            </li>
                            <li class="w-full py-1.5 hover:bg-gray-100">
                                <a href="#" class="px-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined">
                                        settings
                                    </span>
                                    Settings
                                </a>
                            </li>
                            <li class="w-full py-1.5 hover:bg-red-500 hover:text-white">
                                <a href="#" class="px-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined">
                                        logout
                                    </span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </button>
            </nav>
            <nav>
                <button
                    class="hidden relative lg:flex text-2xl items-center justify-center rounded-full p-1 bg-white pointer-cursor hover:bg-gray-300 focus:outline-none focus:ring focus:ring-gray-200 cursor-pointer">
                    <span class="material-symbols-outlined">
                        person
                    </span>
                    <div class="absolute hidden bg-white right-0 top-14 rounded-sm w-36 shadow-md">
                        <ul class="hidden lg:flex flex-col items-start justify-center text-sm">
                            <li class="w-full py-1.5 hover:bg-gray-100">
                                <a href="#" class="px-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined">
                                        home
                                    </span>
                                    Home
                                </a>
                            </li>
                            <li class="w-full py-1.5 hover:bg-gray-100">
                                <a href="#" class="px-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined">
                                        person
                                    </span>
                                    Profile
                                </a>
                            </li>
                            <li class="w-full py-1.5 hover:bg-gray-100">
                                <a href="#" class="px-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined">
                                        settings
                                    </span>
                                    Settings
                                </a>
                            </li>
                            <li class="w-full py-1.5 hover:bg-red-500 hover:text-white">
                                <a href="#" class="px-3 flex items-center gap-1">
                                    <span class="material-symbols-outlined">
                                        logout
                                    </span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </button>
            </nav>
        </div>
    </header>

    <div class="flex h-screen overflow-hidden">
        <aside>
            <ul class="flex flex-col h-[90%]">
                <li>
                    <a href="#" class="sidebar-menu">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                home
                            </span>
                            Dashboard
                        </span>
                    </a>
                </li>
                <li class="font-bold text-xs ml-4 opacity-50 mt-4 mb-1">CRM</li>
                <li x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="sidebar-menu" :class="{ 'font-bold': open }">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                groups
                            </span>
                            Customers
                        </span>
                        <span class="material-symbols-outlined transition-transform opacity-60"
                            :class="{ 'rotate-180': open }">
                            keyboard_arrow_down
                        </span>
                    </button>
                    <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Add
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Search
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                List
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Maps
                            </a>
                        </li>
                    </ul>
                </li>
                <li x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="sidebar-menu" :class="{ 'font-bold': open }">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                partner_exchange
                            </span>
                            Leads
                        </span>
                        <span class="material-symbols-outlined transition-transform opacity-60"
                            :class="{ 'rotate-180': open }">
                            keyboard_arrow_down
                        </span>
                    </button>
                    <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Add Lead
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                List
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Quotes
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Maps
                            </a>
                        </li>
                    </ul>
                </li>
                <li x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="sidebar-menu" :class="{ 'font-bold': open }">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                confirmation_number
                            </span>
                            Tickets
                        </span>
                        <span class="material-symbols-outlined transition-transform opacity-60"
                            :class="{ 'rotate-180': open }">
                            keyboard_arrow_down
                        </span>
                    </button>
                    <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                List
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Archives
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Recipients
                            </a>
                        </li>
                    </ul>
                </li>
                <li x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="sidebar-menu" :class="{ 'font-bold': open }">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                payments
                            </span>
                            Finance
                        </span>
                        <span class="material-symbols-outlined transition-transform opacity-60"
                            :class="{ 'rotate-180': open }">
                            keyboard_arrow_down
                        </span>
                    </button>
                    <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Transaction
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Invoices
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Credit Notes
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Proforma Invoices
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Payments
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                History & Preview
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Payment Statement
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Refill Cards
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Costs
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="font-bold text-xs ml-4 opacity-50 mt-4 mb-1">COMPANY</li>
                <li x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="sidebar-menu" :class="{ 'font-bold': open }">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                cell_tower
                            </span>
                            Networking
                        </span>
                        <span class="material-symbols-outlined transition-transform opacity-60"
                            :class="{ 'rotate-180': open }">
                            keyboard_arrow_down
                        </span>
                    </button>
                    <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Network Sites
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Routers
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                TR-069 (ACS)
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Hardware
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                IPv4 Networks
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                IPv6 Networks
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Maps
                            </a>
                        </li>
                    </ul>
                </li>
                <li x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="sidebar-menu" :class="{ 'font-bold': open }">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                event_note
                            </span>
                            Scheduling
                        </span>
                        <span class="material-symbols-outlined transition-transform opacity-60"
                            :class="{ 'rotate-180': open }">
                            keyboard_arrow_down
                        </span>
                    </button>
                    <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Projects
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Tasks
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Calendar
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Maps
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Archives
                            </a>
                        </li>
                    </ul>
                </li>
                <li x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="sidebar-menu" :class="{ 'font-bold': open }">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                inventory_2
                            </span>
                            Inventory
                        </span>
                        <span class="material-symbols-outlined transition-transform opacity-60"
                            :class="{ 'rotate-180': open }">
                            keyboard_arrow_down
                        </span>
                    </button>
                    <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Items
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Supply
                            </a>
                        </li>
                    </ul>
                </li>
                <li x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="sidebar-menu" :class="{ 'font-bold': open }">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                paid
                            </span>
                            Tariff Plans
                        </span>
                        <span class="material-symbols-outlined transition-transform opacity-60"
                            :class="{ 'rotate-180': open }">
                            keyboard_arrow_down
                        </span>
                    </button>
                    <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                        <li>
                            <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                                Internet
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="font-bold text-xs ml-4 opacity-50 mt-4 mb-1">SYSTEM</li>
                <li>
                    <a href="#" class="sidebar-menu">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                folder_open
                            </span>
                            Administration
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-menu">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[22px]!">
                                settings
                            </span>
                            Config
                        </span>
                    </a>
                </li>
            </ul>
        </aside>
        <main>
            <div class="flex-1 px-8 pt-6 pb-20">
                <div class="row">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined ">
                            home
                        </span>
                        <h1 class="text-xl font-normal text-gray-800">Dashboard</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 gap-4 mt-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="flex gap-2">
                                <span class="material-symbols-outlined text-green-500">
                                    person_check
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">Online Customers</h2>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <a href="#" class="text-sm text-cyan-600">View</a>
                                <p class="font-semibold text-xl text-green-500">10</p>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm h-28">
                            <div class="flex gap-2">
                                <span class="material-symbols-outlined text-blue-500">
                                    person_add
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">New Customers</h2>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <a href="#" class="text-sm text-cyan-600">View</a>
                                <p class="font-semibold text-xl text-blue-500">10</p>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm h-28">
                            <div class="flex gap-2">
                                <span class="material-symbols-outlined text-yellow-500">
                                    confirmation_number
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">New & open tickets</h2>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <a href="#" class="text-sm text-cyan-600">View</a>
                                <p class="font-semibold text-xl text-yellow-500">10</p>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm h-28">
                            <div class="flex gap-2">
                                <span class="material-symbols-outlined text-red-500">
                                    power_settings_circle
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">Devices down</h2>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <a href="#" class="text-sm text-cyan-600">View</a>
                                <p class="font-semibold text-xl text-red-500">10</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-8 -mx-2 opacity-10">
                <div class="row">
                    <div class="w-full bg-white shadow-sm p-4 rounded-lg">
                        <h2 class="font-semibold">Shortcuts</h2>
                        <div class="flex flex-wrap mt-4 py-2 items-center gap-3 text-[#007E41]">
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    person_add
                                </span>
                                <p class="font-normal text-sm">Add Customer</p>
                            </a>
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    partner_exchange
                                </span>
                                <p class="font-normal text-sm">Add Lead</p>
                            </a>
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    confirmation_number
                                </span>
                                <p class="font-normal text-sm">Add Ticket</p>
                            </a>
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    assignment_add
                                </span>
                                <p class="font-normal text-sm">Add Task</p>
                            </a>
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    network_node
                                </span>
                                <p class="font-normal text-sm">Add Router</p>
                            </a>
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    paid
                                </span>
                                <p class="font-normal text-sm">Add Internet Plan</p>
                            </a>
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    receipt_long
                                </span>
                                <p class="font-normal text-sm">View Invoice</p>
                            </a>
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    payments
                                </span>
                                <p class="font-normal text-sm">View Payments</p>
                            </a>
                            <a href="#" class="flex gap-1 hover:-translate-y-0.5 transition-all ease-in-out">
                                <span class="material-symbols-outlined text-[18px]!">
                                    box_add
                                </span>
                                <p class="font-normal text-sm">Add Inventory Item</p>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="columns-1 lg:columns-2 gap-4 space-y-4 mt-4">
                        <div class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid order-1">
                            <div class="flex gap-2 items-center justify-start py-6">
                                <span class="material-symbols-outlined">
                                    host
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">System Status</h2>
                            </div>
                            <hr class="-mx-4 opacity-10">
                            <div class="flex flex-col text-sm">
                                <div class="flex items-center justify-between py-2">
                                    <p>CPU cores</p>
                                    <p>4</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Load Average (1,5,15 min)</p>
                                    <p>0, 0.01, 0.05</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>CPU Usage</p>
                                    <div class="w-[30%] text-center">
                                        <div class="bg-gray-200 w-full font-semibold rounded-md">
                                            0.00 %
                                        </div>
                                    </div>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex flex-col gap-2 lg:flex-row lg:justify-between py-2">
                                    <p>Memory: 3.73 GB (Free 34.75 %)</p>
                                    <div class="flex w-full lg:w-[30%] text-center">
                                        <div
                                            class="bg-yellow-500 w-[65.25%] text-white font-semibold rounded-md rounded-r-none">
                                            Used
                                        </div>
                                        <div
                                            class="bg-green-500 w-[34.75%] text-white font-semibold rounded-md rounded-l-none">
                                            Free
                                        </div>
                                    </div>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>I/O wait</p>
                                    <div class="w-[30%] text-center">
                                        <div class="bg-gray-200 w-full font-semibold rounded-md">
                                            0.00 %
                                        </div>
                                    </div>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Swap:</p>
                                    <div class="flex w-[30%] text-center">
                                        <div
                                            class="bg-yellow-500 w-[80%] text-white font-semibold rounded-md rounded-r-none">
                                            Used
                                        </div>
                                        <div
                                            class="bg-green-500 w-[20%] text-white font-semibold rounded-md rounded-l-none">
                                            Free
                                        </div>
                                    </div>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Disk:</p>
                                    <div class="flex w-[30%] text-center">
                                        <div
                                            class="bg-yellow-500 w-[75%] text-white font-semibold rounded-md rounded-r-none">
                                            Used
                                        </div>
                                        <div
                                            class="bg-green-500 w-[25%] text-white font-semibold rounded-md rounded-l-none">
                                            Free
                                        </div>
                                    </div>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Last DB Backup</p>
                                    <p>about 2 hours ago (148.6 KB)</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Last remote backup</p>
                                    <p class="text-red-500">Never</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                            <div class="flex gap-2 items-center justify-start py-6">
                                <span class="material-symbols-outlined text-cyan-500">
                                    bring_your_own_ip
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">Networking</h2>
                            </div>
                            <hr class="-mx-4 opacity-10">
                            <div class="flex flex-col text-sm">
                                <div class="flex items-center justify-between py-2">
                                    <p>Routers</p>
                                    <p>2</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Monitoring Devices</p>
                                    <p>3</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Devices Down (SNMP)</p>
                                    <p>2</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Devices Down (Ping)</p>
                                    <p>1</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>IPv4 networks</p>
                                    <p>2</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Total private addresses</p>
                                    <p>508</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Private addresses used</p>
                                    <p>3</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Total public addresses </p>
                                    <p>0</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Public addresses used </p>
                                    <p>0</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                            <div class="flex gap-2 items-center justify-start py-6">
                                <span class="material-symbols-outlined text-cyan-500">
                                    partner_exchange
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">Leads</h2>
                            </div>
                            <hr class="-mx-4 opacity-10">
                            <div class="flex flex-col text-sm">
                                <div class="flex items-center justify-between py-2">
                                    <p>Task for today</p>
                                    <p>0</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>New leads</p>
                                    <p>3</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Active leads</p>
                                    <p>3</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Deals</p>
                                    <p>0</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                            <div class="flex gap-2 items-center justify-start py-6">
                                <span class="material-symbols-outlined text-cyan-500">
                                    groups
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">Customers</h2>
                            </div>
                            <hr class="-mx-4 opacity-10">
                            <div class="flex flex-col text-sm">
                                <div class="flex items-center justify-between py-2">
                                    <p>Total</p>
                                    <p>26</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>New</p>
                                    <p>10</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Active</p>
                                    <p>11</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Online</p>
                                    <p>5</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Online last 24 hours</p>
                                    <p>5</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Blocked</p>
                                    <p>2</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Inactive</p>
                                    <p>3</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Added last month</p>
                                    <p>1</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Added last year</p>
                                    <p>1</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                            <div class="flex gap-2 items-center justify-start py-6">
                                <span class="material-symbols-outlined text-cyan-500">
                                    payments
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">Finance</h2>
                            </div>
                            <div class="flex flex-col text-sm">
                                <div class="flex items-center justify-between py-2">
                                    <p class="text-green-500 font-semibold text-sm">Current Month</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Payments</p>
                                    <p>7 (29700.00 $)</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Paid invoices</p>
                                    <p>7 (29700.00 $)</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Unpaid invoices</p>
                                    <p>4 (3986.45 $)</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Credit notes</p>
                                    <p>0 (0.00 $)</p>
                                </div>
                                <div class="flex items-center justify-between py-2 mt-6">
                                    <p class="font-semibold text-sm text-yellow-500">Last Month</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Payments</p>
                                    <p>0 (0.00 $)</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Paid invoices</p>
                                    <p>0 (0.00 $)</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Unpaid invoices</p>
                                    <p>0 (0.00 $)</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Credit notes</p>
                                    <p>0 (0.00 $)</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                            <div class="flex gap-2 items-center justify-start py-6">
                                <span class="material-symbols-outlined text-cyan-500">
                                    confirmation_number
                                </span>
                                <h2 class="text-base font-semibold text-gray-800">Tickets</h2>
                            </div>
                            <hr class="-mx-4 opacity-10">
                            <div class="flex flex-col text-sm">
                                <div class="flex items-center justify-between py-2">
                                    <p>New</p>
                                    <p>1</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Work in progress</p>
                                    <p>3</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Resolved</p>
                                    <p>4</p>
                                </div>
                                <hr class="-mx-4 opacity-10">
                                <div class="flex items-center justify-between py-2">
                                    <p>Waiting on agent</p>
                                    <p>1</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer>
                <p class="text-center text-xs text-white my-2">© 2026 <strong>Awinet</strong>. All rights reserved.</p>
            </footer>
        </main>
    </div>
</body>

</html>
