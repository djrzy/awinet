<aside :class="sidebarOpen ? 'w-60' : 'w-0'" x-cloak>
    <ul class="flex flex-col pb-16">
        <li>
            <a href="/" class="sidebar-menu h-9 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[22px]!">
                        home
                    </span>
                    Dashboard
                </span>
            </a>
        </li>
        <li class="font-bold text-xs ml-4 opacity-50 mt-4 mb-1">CRM</li>
        <li x-data="{
            open: {{ request()->routeIs('customer*') ? 'true' : 'false' }}
        }" @click.away="open = false">
            <button @click="open = !open"
                class="sidebar-menu h-9 {{ request()->routeIs('customer*') ? 'bg-secondary font-semibold' : '' }}"
                :class="{ 'font-semibold': open }">
                <span class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[22px]!">
                        groups
                    </span>
                    Customers
                </span>
                <span class="material-symbols-outlined transition-transform opacity-60" :class="{ 'rotate-180': open }">
                    keyboard_arrow_down
                </span>
            </button>
            <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                <li>
                    <a href="{{ route('customer') }}"
                        class="hover:text-white hover:bg-white/30 pl-12.5 flex justify-between items-center h-9 {{ request()->routeIs('customer') ? 'font-semibold' : '' }}">
                        List
                        {!! request()->routeIs('customer') ? '<div class="w-1 h-9 bg-[#F14F10]"></div>' : '' !!}
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.add') }}"
                        class="hover:text-white hover:bg-white/30 pl-12.5 flex justify-between items-center h-9 {{ request()->routeIs('customer.add') ? 'font-semibold' : '' }}">
                        Add
                        {!! request()->routeIs('customer.add') ? '<div class="w-1 h-9 bg-[#F14F10]"></div>' : '' !!}
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.maps') }}"
                        class="hover:text-white hover:bg-white/30 pl-12.5 flex justify-between items-center h-9 {{ request()->routeIs('customer.maps') ? 'font-semibold' : '' }}">
                        Maps
                        {!! request()->routeIs('customer.maps') ? '<div class="w-1 h-9 bg-[#F14F10]"></div>' : '' !!}
                    </a>
                </li>
                {{-- <li>
                    <a href="#" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
                        Maps
                    </a>
                </li> --}}
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
                <span class="material-symbols-outlined transition-transform opacity-60" :class="{ 'rotate-180': open }">
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
                <span class="material-symbols-outlined transition-transform opacity-60" :class="{ 'rotate-180': open }">
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
                <span class="material-symbols-outlined transition-transform opacity-60" :class="{ 'rotate-180': open }">
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
                    <a href="{{ route('invoice') }}" class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
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
                    <a href="{{ route('admin.routers') }}"
                        class="block py-2 hover:text-white hover:bg-white/30 pl-12.5">
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
        <li x-data="{
            open: {{ request()->routeIs('plan*') ? 'true' : 'false' }}
        }" @click.away="open = false">
            <button @click="open = !open"
                class="sidebar-menu {{ request()->routeIs('plan.*') ? 'bg-secondary' : '' }}"
                :class="{ 'font-semibold': open }">
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
                    <a href="{{ route('plan.internet') }}"
                        class="block py-2 hover:text-white hover:bg-white/30 pl-12.5 {{ request()->routeIs('plan.internet') ? 'font-semibold' : '' }}">
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
                        search_activity
                    </span>
                    Activity Log
                </span>
            </a>
        </li>
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
        {{-- <li>
            <a href="#" class="sidebar-menu">
                <span class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[22px]!">
                        settings
                    </span>
                    Config
                </span>
            </a>
        </li> --}}
        <li x-data="{
            open: {{ request()->is('setting*') ? 'true' : 'false' }}
        }" @click.away="open = false">
            <button @click="open = !open" class="sidebar-menu {{ request()->is('setting*') ? 'bg-secondary' : '' }}"
                :class="{ 'font-semibold': open }">
                <span class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[22px]!">
                        settings
                    </span>
                    Setting
                </span>
                <span class="material-symbols-outlined transition-transform opacity-60"
                    :class="{ 'rotate-180': open }">
                    keyboard_arrow_down
                </span>
            </button>
            <ul x-show="open" x-collapse x-cloak class="text-sm space-y-0">
                <li>
                    <a href="{{ route('admin.billing-cycles.create') }}"
                        class="block py-2 hover:text-white hover:bg-white/30 pl-12.5
                        {{ request()->routeIs('admin.billing-cycles.create') ? 'font-semibold' : '' }}
                         ">
                        Billing Cycle
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
