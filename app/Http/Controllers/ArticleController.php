<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(){
        return view('admin.artikel.index', [
            'articles'=>Article::orderBy('id', 'desc')->get()
        ]);
    }

    public function create(){
        return view('admin.artikel.create');
    }

    public function store(Request $request){
        $rules = [
            'title'=> 'required',
            'image'=> 'required|max:1000|mimes:jpg,jpeg,png,webp',
            'desc'=> 'required|min:20',
        ];

        $message = [
            'title.required' => 'judul artikel wajib diisi',
            'image.required' => 'gambar artikel wajib diisi',
            'desc.required' => 'deskripsi artikel wajib diisi',
        ];

        $this -> validate($request, $rules, $message);

        // Pengaturan image
        $fileName = time(). '.' . $request->image->extension();
        $request->file('image')->storeAs('public/article', $fileName);

        //Pengaturan article
        $storage= "storage/content-article";
        $dom = new \DOMDocument();

        //untuk menonaktifkan kesalahan libxml standar dan memungkinkan penanganan kesalahan pengguna
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        //menghapus buffer kesalahan libxml
        libxml_clear_errors();

        
        $image = $dom->getElementsByTagName('img');

        foreach($image as $img){
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)){
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filePath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)->resize(1440, 720)->encode($mimetype, 100)->save(public_path($filePath));
                $new_src = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        Article::create([
            'title'=> $request->title,
            'slug'=> Str::slug($request->title, '-'),
            'image'=> $fileName,
            'desc'=> $dom->saveHTML(),
        ]);

        return redirect(route('article'))->with('succes', 'data berhasil di simpan');
    }

    public function edit($id){
        return view('admin.artikel.edit');
    }

    public function update(Request $request, $id){
        // return view('admin/artikel.index');
    }

    public function destroy($id){
        // return view('admin/artikel.index');
    }
}
