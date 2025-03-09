<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-indigo-900">
    <div class="min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-24 w-auto" src="{{ asset('img/logo.png') }}" alt="Logo" />
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white mb-5">
                Login
            </h2>
            <div class="bg-white py-8 px-4 shadow rounded-lg sm:rounded-lg sm:px-10">
                <div class="text-sm mb-4 text-center">
                    Mau ke Beranda Website?
                    <a href="{{ route('dashboard-website') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500">
                        Klik di sini
                    </a>
                </div>

                <form id="login-form" class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                        <div class="mt-1 shadow-xl border-gray-500">
                            <input id="email" name="email" type="email" required autofocus autocomplete="email"
                                value="{{ old('email') }}"
                                class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            @error('email')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 shadow-xl border-gray-500 relative">
                            <input id="password" name="password" type="password" required
                                autocomplete="{{ old('remember') ? 'current-password' : 'new-password' }}"
                                class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 px-3 flex items-center">
                                <i id="eyeIcon" class="fas fa-eye-slash text-gray-500"></i>
                            </button>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember" type="checkbox"
                                {{ old('remember') ? 'checked' : '' }}
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="mx-auto block w-auto bg-indigo-600 text-white py-2 px-4 mt-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-indigo-200">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Mendapatkan elemen dari DOM
        const passwordInput = document.getElementById("password");
        const togglePassword = document.getElementById("togglePassword");
        const eyeIcon = document.getElementById("eyeIcon");
        const forgotPasswordLink = document.getElementById("forgotPasswordLink");

        // Event listener untuk toggle visibility password
        togglePassword.addEventListener("click", function() {
            const currentType = passwordInput.getAttribute("type");

            if (currentType === "password") {
                // Ubah tipe menjadi text
                passwordInput.setAttribute("type", "text");
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye"); // Mata terbuka
            } else {
                // Ubah tipe kembali menjadi password
                passwordInput.setAttribute("type", "password");
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash"); // Mata tertutup
            }
        });
    </script>
</body>

</html>
