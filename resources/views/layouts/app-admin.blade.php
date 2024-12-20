<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    @include('layouts.style-user')
</head>

<body class="bg-gray-100 font-poppins">
    @include('layouts.menu-admin')
    @yield('content-admin')

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success'
                });
            });
        </script>
    @endif
    <script src="{{ asset('js/js-web.js') }}"></script>
    <script src="{{ asset('js/js-admin.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>



    <script src="{{ asset('js/admin/summernote.js') }}"></script>
    <script src="{{ asset('js/admin/sidebar.js') }}"></script>

    @yield('scripts')
</body>

</html>
