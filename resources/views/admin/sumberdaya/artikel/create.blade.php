<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kelola Artikel</title>
  @include('layouts.style')
  {{-- summernote css --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
  
  <script type="text/javascript">
  $(document).ready(function(){
    $('#summernote').summernote({
      height: 200,
    });
  });
  </script>

</head>
<body>
  <h1>Halaman buat Artikel</h1>
  <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="form-group">
    <label for="">Masukkan Judul Artikel</label>
    <input type="text" name="title" @error('title')
        is-invalid
    @enderror value="{{ old('title') }}">

    @error('title')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="form-group">
    <label for="">Pilih Gambar Artikel</label>
    <input type="file" name="image" @error('image')
        is-invalid
    @enderror>

    @error('image')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>


  <div class="form-group">
    <label for="">Isi Artikel</label>
    <textarea name="desc" id="summernote">
      {{ old('desc') }}
    </textarea>

    @error('desc')
    <div class="text-danger">
      {{ $message }}
    </div>
    @enderror
  </div>


  
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
  <br><br><br><br><br><br>
  <a href="{{ route('article') }}">Kembali</a>
  @include('layouts.script')
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfktSj8PCmoN9aaq30gDh27xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>
</body>
</html>