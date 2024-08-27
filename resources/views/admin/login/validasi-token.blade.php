<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-indigo-900">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-24 w-auto" src="../img/logo.png" alt="Logo" />
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                RESET PASSWORD
            </h2>
            <p class="mt-2 text-center text-sm text-gray-200">
                masukkan password baru kamu
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="{{ route('validasi-forgot-password-act') }}" method="POST">
                    @csrf
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password baru
                        </label>
                        <div class="mt-1">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input id="password" name="password" type="password" autocomplete="password" required
                                placeholder="Masukkan password baru"
                                class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white py-2 px-4 mt-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-indigo-200 block mx-auto sm:w-auto">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
