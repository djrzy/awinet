<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('awinet.png') }}" type="image/x-icon">

    @vite('resources/css/app.css')
</head>

<body>

    <div class="flex items-center justify-center h-screen bg-linear-to-br from-[#007E41] from-25%  to-[#F14F10] to-75%">
        <div class="w-full max-w-sm p-8 space-y-6 bg-gray-300 rounded-xl shadow-xl lg:hidden">
            <img src="{{ asset('awinet.png') }}" alt="Company Logo" class="mx-auto h-16 w-auto">
            <h2 class="text-xl font-semibold text-center">Login</h2>
            <form action="#" method="POST" class="space-y-3">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="flex items-center justify-between">
                    <a href="#" class="text-xs italic underline text-blue-500 hover:text-blue-700">Forgot
                        Password?</a>
                    <div class="flex items-center gap-1">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="text-xs">Remember me</label>
                    </div>
                </div>
                <button type="submit"
                    class="w-full px-4 py-2 font-bold text-white bg-black rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200">
                    Login
                </button>
            </form>

        </div>
        <div class="hidden lg:block lg:w-[60%]">
            {{-- <img src="{{ asset('awinet.png') }}" alt="Company Logo" class="mx-auto h-16 w-auto"> --}}
            <h2 class="text-3xl font-bold text-center text-white mt-4">Welcome to Awinet</h2>
            <p class="text-center text-white mt-2">Please login to your account to continue</p>
        </div>
        <div
            class="hidden lg:flex flex-col lg:w-[40%] lg:px- bg-gray-200 h-screen items-center space-y-3 justify-center">
            <img src="{{ asset('awinet.png') }}" alt="Company Logo" class="mx-auto h-16 w-auto">
            <h2 class="text-xl font-semibold text-center">Login</h2>
            <form action="#" method="POST" class="space-y-4 w-full max-w-lg">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:ring-blue-200">
                </div>
                <div class="flex items-center justify-between">
                    <a href="#" class="text-xs italic underline text-blue-500 hover:text-blue-700">Forgot
                        Password?</a>
                    <div class="flex items-center gap-1">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember" class="text-xs">Remember me</label>
                    </div>
                </div>
                <button type="submit"
                    class="w-full px-4 py-2 font-bold text-white bg-black rounded hover:bg-[#007E41] focus:outline-none focus:ring focus:ring-blue-200 cursor-pointer">
                    Login
                </button>
            </form>
        </div>

    </div>

</body>

</html>
