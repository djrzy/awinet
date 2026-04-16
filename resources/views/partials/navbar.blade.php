<header>
    <div class="flex items-center gap-3 lg:-ml-2 w-full lg:w-auto">
        <div class="w-1/3">
            <button @click="sidebarOpen = !sidebarOpen"
                class="bg-gray-50 p-0.5 rounded-md flex items-center justify-center shadow-sm cursor-pointer active:shadow-sm active:translate-y-px">
                <span class="material-symbols-outlined">
                    menu
                </span>
            </button>
        </div>
        <img src="{{ asset('awinet.png') }}" alt="Company Logo" class="h-8 w-auto mx-auto">
        <div class="w-1/3"></div>
    </div>
    <div class="flex">
        {{-- <nav>
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
        </nav> --}}
        {{-- <nav>
            <button @click="profiledropdownOpen = !profiledropdownOpen"
                class="hidden shadow-sm active:translate-y-px lg:flex text-2xl items-center justify-center rounded-full p-1 bg-gray-50 pointer-cursor cursor-pointer">
                <span class="material-symbols-outlined">
                    person
                </span>
                <div class="hidden absolute bg-white right-0 top-[130%] rounded-sm w-36 shadow-md py-1">
                    <ul class="hidden lg:flex flex-col items-start justify-center text-sm">
                        <li class="w-full py-0.5">
                            <a href="#"
                                class="px-2 mx-1.5 py-1 flex items-center gap-1 rounded-sm hover:bg-gray-100">
                                <span class="material-symbols-outlined">
                                    home
                                </span>
                                Home
                            </a>
                        </li>
                        <li class="w-full py-0.5">
                            <a href="#"
                                class="px-2 mx-1.5 py-1 flex items-center gap-1 rounded-sm hover:bg-gray-100">
                                <span class="material-symbols-outlined">
                                    person
                                </span>
                                Profile
                            </a>
                        </li>
                        <li class="w-full py-0.5">
                            <a href="#"
                                class="px-2 mx-1.5 py-1 flex items-center gap-1 rounded-sm hover:bg-gray-100">
                                <span class="material-symbols-outlined">
                                    settings
                                </span>
                                Settings
                            </a>
                        </li>
                        <li class="w-full py-0. hover:text-white">
                            <a href="#"
                                class="px-2 mx-1.5 py-1 flex items-center gap-1 rounded-sm hover:bg-red-500">
                                <span class="material-symbols-outlined">
                                    logout
                                </span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </button>
        </nav> --}}
        <nav x-data="{ profileOpen: false, notificationsOpen: false }" class="relative flex items-center gap-3">
            <button @click="notificationsOpen = !notificationsOpen"
                class="hidden shadow-sm active:translate-y-px lg:flex text-2xl items-center justify-center rounded-full p-1 bg-gray-50 cursor-pointer">
                <span class="material-symbols-outlined">
                    notifications
                </span>
            </button>

            <button @click="profileOpen = !profileOpen"
                class="hidden shadow-sm active:translate-y-px lg:flex text-2xl items-center justify-center rounded-full p-1 bg-gray-50 cursor-pointer">
                <span class="material-symbols-outlined">
                    person
                </span>
            </button>

            <div x-show="profileOpen" @click.away="profileOpen = false" x-transition x-cloak
                class="absolute right-0 top-[130%] bg-white rounded-sm w-auto shadow-md py-2 px-1">
                <div class="flex flex-col px-2 mx-1.5 py-0.5 text-sm">
                    <h1 class="text-gray-800"><strong>Name</strong></h1>
                    <p class="text-gray-800/40">email@email.com</p>
                </div>
                <hr class="my-1 -mx-1 opacity-20">
                <ul class="flex flex-col text-sm text-gray-800">
                    <li class="w-full py-0.5">
                        <a href="#" class="px-2 mx-1.5 py-1 flex items-center gap-1 rounded-sm hover:bg-gray-100">
                            <span class="material-symbols-outlined">home</span>
                            Home
                        </a>
                    </li>

                    <li class="w-full py-0.5">
                        <a href="#" class="px-2 mx-1.5 py-1 flex items-center gap-1 rounded-sm hover:bg-gray-100">
                            <span class="material-symbols-outlined">person</span>
                            Profile
                        </a>
                    </li>

                    <li class="w-full py-0.5">
                        <a href="#" class="px-2 mx-1.5 py-1 flex items-center gap-1 rounded-sm hover:bg-gray-100">
                            <span class="material-symbols-outlined">settings</span>
                            Settings
                        </a>
                    </li>

                    <li class="w-full py-0.5">
                        <a href="#"
                            class="px-2 mx-1.5 py-1 flex items-center gap-1 rounded-sm hover:bg-red-500 hover:text-white">
                            <span class="material-symbols-outlined">logout</span>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
            <div x-show="notificationsOpen" @click.away="notificationsOpen = false" x-transition x-cloak
                class="absolute right-[50%] top-[130%] bg-white rounded-sm w-80 shadow-md py-1">
                <div class="flex px-2 mx-1.5 py-1 text-sm justify-between items-center">
                    <h1 class="text-gray-800"><strong>Notifications</strong></h1>
                    <p class="text-xs">Clear All</p>
                </div>
                <hr class="my-1 -mx-0.5 opacity-20">
                <ul class="flex flex-col text-sm text-gray-800 overflow-y-auto max-h-60">
                    <li>
                        <a href="#" class="px-4 py-1 flex gap-4 items-center hover:bg-gray-100">
                            <span class="material-symbols-outlined">home</span>
                            <div class="flex flex-col gap-px">
                                <h1 class="font-semibold">Notification Title</h1>
                                <p>Notification content goes here.</p>
                                <p class="text-xs text-gray-500">Time ago</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <hr class="my-1 -mx-0.5 opacity-20">
                <div class="flex px-2 mx-1.5 py-1 text-sm justify-center items-center">
                    <h1 class="text-gray-800"><strong>View All</strong></h1>
                </div>
            </div>
        </nav>
    </div>
</header>
