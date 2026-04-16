@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="flex items-center gap-2">
            <span class="material-symbols-outlined ">
                home
            </span>
            <h1 class="text-xl font-normal text-gray-800">
                @hasSection('title')
                    @yield('title')
                @else
                @endif
            </h1>
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
            <div x-data="{ systemStatusOpen: true }" class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid order-1">
                <div class="flex items-center justify-between py-6">
                    <div class="flex gap-2">
                        <span class="material-symbols-outlined">
                            host
                        </span>
                        <h2 class="text-base font-semibold text-gray-800">System Status</h2>
                    </div>
                    <button @click="systemStatusOpen = !systemStatusOpen" class="flex items-center justify-center p-1">
                        <span class="material-symbols-outlined cursor-pointer">
                            keyboard_arrow_down
                        </span>
                    </button>
                </div>
                <div x-show="systemStatusOpen" x-collapse x-cloak>
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
                        <div class="flex flex-col gap-2 lg:flex-row lg:justify-between py-2">
                            <p>CPU Usage</p>
                            <div class="flex w-full lg:w-[40%] text-center">
                                <div class="bg-gray-200 w-full font-semibold rounded-md">
                                    0.00 %
                                </div>
                            </div>
                        </div>
                        <hr class="-mx-4 opacity-10">
                        <div class="flex flex-col gap-2 lg:flex-row lg:justify-between py-2">
                            <p>Memory: 3.73 GB (Free 34.75 %)</p>
                            <div class="flex w-full lg:w-[40%] text-center">
                                <div class="bg-yellow-500 w-[65.25%] text-white font-semibold rounded-md rounded-r-none">
                                    Used
                                </div>
                                <div class="bg-green-500 w-[34.75%] text-white font-semibold rounded-md rounded-l-none">
                                    Free
                                </div>
                            </div>
                        </div>
                        <hr class="-mx-4 opacity-10">
                        <div class="flex flex-col gap-2 lg:flex-row lg:justify-between py-2">
                            <p>I/O wait</p>
                            <div class="flex w-full lg:w-[40%] text-center">
                                <div class="bg-gray-200 w-full font-semibold rounded-md">
                                    0.00 %
                                </div>
                            </div>
                        </div>
                        <hr class="-mx-4 opacity-10">
                        <div class="flex flex-col gap-2 lg:flex-row lg:justify-between py-2">
                            <p>Swap:</p>
                            <div class="flex w-full lg:w-[40%] text-center">
                                <div class="bg-yellow-500 w-[80%] text-white font-semibold rounded-md rounded-r-none">
                                    Used
                                </div>
                                <div class="bg-green-500 w-[20%] text-white font-semibold rounded-md rounded-l-none">
                                    Free
                                </div>
                            </div>
                        </div>
                        <hr class="-mx-4 opacity-10">
                        <div class="flex flex-col gap-2 lg:flex-row lg:justify-between py-2">
                            <p>Disk:</p>
                            <div class="flex w-full lg:w-[40%] text-center">
                                <div class="bg-yellow-500 w-[75%] text-white font-semibold rounded-md rounded-r-none">
                                    Used
                                </div>
                                <div class="bg-green-500 w-[25%] text-white font-semibold rounded-md rounded-l-none">
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
            </div>
            <div x-data="{ networkingOpen: true }" class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                <div class="flex items-center justify-between py-6">
                    <div class="flex gap-2">
                        <span class="material-symbols-outlined text-cyan-500">
                            bring_your_own_ip
                        </span>
                        <h2 class="text-base font-semibold text-gray-800">Networking</h2>
                    </div>
                    <button @click="networkingOpen = !networkingOpen" class="flex items-center justify-center p-1">
                        <span class="material-symbols-outlined cursor-pointer">
                            keyboard_arrow_down
                        </span>
                    </button>
                </div>
                <div x-show="networkingOpen" x-collapse x-cloak>
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
            </div>
            <div x-data="{ leadsOpen: true }" class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                <div class="flex items-center justify-between py-6">
                    <div class="flex gap-2">
                        <span class="material-symbols-outlined text-cyan-500">
                            partner_exchange
                        </span>
                        <h2 class="text-base font-semibold text-gray-800">Leads</h2>
                    </div>
                    <button @click="leadsOpen = !leadsOpen" class="flex items-center justify-center p-1">
                        <span class="material-symbols-outlined cursor-pointer">
                            keyboard_arrow_down
                        </span>
                    </button>
                </div>
                <div x-show="leadsOpen" x-collapse x-cloak>
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
            </div>
            <div x-data="{ customersOpen: true }" class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                <div class="flex items-center justify-between py-6">
                    <div class="flex gap-2">
                        <span class="material-symbols-outlined text-cyan-500">
                            groups
                        </span>
                        <h2 class="text-base font-semibold text-gray-800">Customers</h2>
                    </div>
                    <button @click="customersOpen = !customersOpen" class="flex items-center justify-center p-1">
                        <span class="material-symbols-outlined cursor-pointer">
                            keyboard_arrow_down
                        </span>
                    </button>
                </div>
                <div x-show="customersOpen" x-collapse x-cloak>
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
            </div>
            <div x-data="{ financeOpen: true }" class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                <div class="flex items-center justify-between py-6">
                    <div class="flex gap-2">
                        <span class="material-symbols-outlined text-cyan-500">
                            payments
                        </span>
                        <h2 class="text-base font-semibold text-gray-800">Finance</h2>
                    </div>
                    <button @click="financeOpen = !financeOpen" class="flex items-center justify-center p-1">
                        <span class="material-symbols-outlined cursor-pointer">
                            keyboard_arrow_down
                        </span>
                    </button>
                </div>
                <div x-show="financeOpen" x-collapse x-cloak class="flex flex-col text-sm">
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
            <div x-data="{ ticketsOpen: true }" class="bg-white px-4 rounded-lg shadow-sm break-inside-avoid">
                <div class="flex items-center justify-between py-6">
                    <div class="flex gap-2">
                        <span class="material-symbols-outlined text-cyan-500">
                            confirmation_number
                        </span>
                        <h2 class="text-base font-semibold text-gray-800">Tickets</h2>
                    </div>
                    <button @click="ticketsOpen = !ticketsOpen" class="flex items-center justify-center p-1">
                        <span class="material-symbols-outlined cursor-pointer">
                            keyboard_arrow_down
                        </span>
                    </button>
                </div>
                <div x-show="ticketsOpen" x-collapse x-cloak class="flex flex-col text-sm">
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
@endsection
