<!--  link CSS Tailwind -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
<!--  link CSS Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Font Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap" />
<link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet" />
<link href="https://fonts.cdnfonts.com/css/amoera" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<link href="{{ asset('css/style.css') }}" rel="stylesheet" />

<style>
    .line-clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        /* Ubah angka ini untuk menyesuaikan jumlah baris */
        overflow: hidden;
    }



    /* Marker hijau untuk desa */
    .marker-green {
        background-color: transparent;
    }

    /* Marker biru untuk UMKM */
    .marker-blue {
        background-color: transparent;
    }

    #map {
        height: 700px;
        width: auto;
        position: relative;
        z-index: 0;
    }

    .leaflet-top,
    .leaflet-right {
        z-index: 30;
    }

    /* Kelas CSS untuk tombol Cancel */
    .swal2-cancel {
        background-color: #9c1722;
        /* Ganti warna sesuai kebutuhan */
        color: white;
    }



    /* konfigurasi summernote tertentu */
    .note-editor ul,
    .note-editor ol {
        padding-left: 40px;
        list-style-type: disc;
    }

    .note-editor ol {
        list-style: decimal;
    }

    .note-editor h1 {
        font-size: 2.5em;
    }

    .note-editor h2 {
        font-size: 2em;
    }

    .note-editor h3 {
        font-size: 1.75em;
    }

    .note-editor h4 {
        font-size: 1.5em;
    }

    .note-editor h5 {
        font-size: 1.25em;
    }

    .note-editor h6 {
        font-size: 1em;
    }

    .note-editor table {
        border-collapse: collapse;
        /* border: 2px solid #3498db; */
    }

    .note-editor table th,
    .note-editor table td,
    .note-editor table tr,
    .note-editor table tbody {
        border: 2px solid #3498db;
        padding: 8px;
        text-align: left;
    }

    .note-editor .note-editable img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .note-editable {
        height: 500px;
    }

    .note-editable a {
        color: blue !important;
    }

    .note-editable table {
        margin: 0 auto;
    }


    /* pengaturan untuk hasil summernote */
    ul,
    ol {
        padding-left: 40px;
        list-style-type: disc;
    }

    ol {
        list-style: decimal;
    }

    h1 {
        font-size: 2.5em;
    }

    h2 {
        font-size: 2em;
    }

    h3 {
        font-size: 1.75em;
    }

    h4 {
        font-size: 1.5em;
    }

    h5 {
        font-size: 1.25em;
    }

    h6 {
        font-size: 1em;
    }

    table {
        border-collapse: collapse;
        /* border: 2px solid #3498db; */
    }

    th,
    td,
    tr,
    tbody {
        border: 2px solid #3498db;
        padding: 8px;
        text-align: left;
    }

    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    /* a {
        color: blue !important;
    } */

    table {
        margin: 0 auto;
    }


    .prose img {
        max-width: 100%;
        height: auto;
    }
</style>
