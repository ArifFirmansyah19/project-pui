<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kelola Artikel</title>
  @include('layouts.style')
</head>
<body>
  <h1>Halaman Kelola Artikel</h1>
  <div class="card">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>Image</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php
              $no = 1;
          @endphp
          @foreach ($articles as $article)
              <tr>
                <td>{{ $no++ }}</td>
                <td>
                  <img src="{{ asset('storage/article/'. $article->image) }}" height="100px" width="100px" alt="">
                </td>
                <td>
                  {{ $article->title }}
                </td>
                <a href="" class="btn btn-warning">Edit</a>
                <form action="" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <br><br><br><br><br><br><br>
  <a href="{{ route('article.create') }}" class="hover:text-gray-400;">Tambahkan Artikel</a>
  @include('layouts.script');
</body>
</html>