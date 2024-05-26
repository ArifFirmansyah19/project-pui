<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <title>Website PUI GEMAR</title> --}}
    <title> @yield('title') </title>
    @include('layouts.style')
  </head>
  <body class="font-roboto">

    @include('layouts.nav-pui')

    @yield('content')

    @include('layouts.footer')
    <!--  link JavaScript -->
    @include('layouts.script');
  </body>
</html>
