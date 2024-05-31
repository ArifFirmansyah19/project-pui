<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"/>
  </head>
  <body class="bg-indigo-900">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-24 w-auto" src="{{ asset('img/logo.png') }}" alt="Logo" />
        <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
          Login
        </h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <form class="space-y-6" action="/login" method="POST">
            @csrf
            <div>
              <label
                for="email"
                class="block text-sm font-medium text-gray-700"
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror>
                Email address
              </label>
              <div class="mt-1">
                <input
                  id="email"
                  name="email"
                  type="email"
                  autocomplete="email"
                  required autofocus value="{{ old('email') }}" @error('email')
                      is-invalid
                  @enderror
                  class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
              </div>
            </div>

            <div>
              <label
                for="password"
                class="block text-sm font-medium text-gray-700">
                Password
              </label>
              <div class="mt-1">
                <input
                  id="password"
                  name="password"
                  type="password"
                  autocomplete="current-password"
                  required
                  class="appearance-none block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                />
              </div>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox"
                  class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"/>
                <label
                  for="remember-me" class="ml-2 block text-sm text-gray-900">
                  Remember me
                </label>
            </div>

             <div class="text-sm">
                <a href="{{ route('login.forgotPw') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                  Forgot your password?
                </a>
            </div>
          </div>

          <div>
              <button type="submit" class="mx-auto block w-auto bg-indigo-600 text-white py-2 px-4 mt-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-indigo-200">
                Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
