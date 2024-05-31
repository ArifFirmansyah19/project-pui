<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SumberDayaController extends Controller
{
    public function artikel(){
        return view('user/sumberdaya.artikel');
    }
    
    public function kegiatan(){
        return view('user/sumberdaya.kegiatan');
    }

    public function peta(){
        return view('user/sumberdaya.peta');
    }
}
