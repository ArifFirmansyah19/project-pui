<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> @yield('title') </title>
    @include('layouts.style-user')
</head>

<body class="bg-gray-100">
    @include('layouts.menu-admin')
    @yield('content-admin')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>


    <script src="{{ asset('js/admin/summernote.js') }}"></script>
    <script src="{{ asset('js/admin/sidebar.js') }}"></script>

    @yield('scripts')
    <script>
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda akan keluar dari akses sebagai admin!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin!',
                cancelButtonText: 'Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        });
    </script>
</body>

</html>
