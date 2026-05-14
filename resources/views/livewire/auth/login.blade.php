<div class="flex items-center justify-center h-screen bg-linear-to-br from-[#007E41] from-25%  to-[#F14F10] to-75%">
    <div class="w-full max-w-sm p-8 space-y-6 bg-white rounded-xl shadow-xl lg:hidden">
        <img src="{{ asset('awinet.png') }}" alt="Company Logo" class="mx-auto h-16 w-auto">
        <h2 class="text-xl font-semibold text-center">Login</h2>
        <form wire:submit.prevent="login" class="space-y-3">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="email"
                    class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('email')
                    <span class="text-red-500 text-xs block text-end">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" wire:model="password" {{-- id="password" name="password" required --}}
                    class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('password')
                    <span class="text-red-500 text-xs block text-end">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <a href="#" class="text-xs italic underline text-blue-500 hover:text-blue-700">Forgot
                    Password?</a>
                <div class="flex items-center gap-1">
                    <input type="checkbox" wire:model="remember">
                    <label for="remember" class="text-xs">Remember me</label>
                </div>
            </div>
            <button type="submit"
                class="w-full px-4 py-2 font-bold text-white bg-black rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200">
                Login
            </button>
        </form>
        @error('status')
            <span class="text-red-500 text-sm text-center w-full block">{{ $message }}</span>
        @enderror
    </div>
    <div class="hidden lg:block lg:w-[70%]">
        <h2 class="text-3xl font-bold text-center text-white mt-4">Welcome to Awinet</h2>
        <p class="text-center text-white mt-2">Please login to your account to continue</p>
    </div>
    <div class="hidden lg:flex flex-col lg:w-[30%] lg:px-12 bg-gray-100 h-screen items-center space-y-3 justify-center">
        <img src="{{ asset('awinet.png') }}" alt="Company Logo" class="mx-auto h-16 w-auto">
        <h2 class="text-xl font-semibold text-center">Login</h2>
        <form wire:submit.prevent="login" class="space-y-4 w-full max-w-lg">
            {{-- @csrf --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" wire:model="email"
                    class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('email')
                    <span class="text-red-500 text-xs block text-end">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" {{-- id="password" name="password"
                required --}} wire:model="password"
                    class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('password')
                    <span class="text-red-500 text-xs block text-end">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <a href="#" class="text-xs italic underline text-blue-500 hover:text-blue-700">Forgot
                    Password?</a>
                <div class="flex items-center gap-1">
                    <input type="checkbox" {{-- name="remember" id="remember" --}} wire:model="remember">
                    <label for="remember" class="text-xs">Remember me</label>
                </div>
            </div>
            <button type="submit"
                class="w-full px-4 py-2 font-bold text-white bg-black rounded hover:bg-[#007E41] focus:outline-none focus:ring focus:ring-blue-200 cursor-pointer">
                Login
            </button>
        </form>
        @error('status')
            <span class="text-red-500 text-sm text-center w-full">{{ $message }}</span>
        @enderror
    </div>
</div>
