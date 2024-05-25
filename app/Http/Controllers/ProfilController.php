<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function sejarah(){
        return view('profil.sejarah');
    }
    
    public function timGemar(){
        return view('profil.team');
    }

    public function visimisi(){
        return view('profil.visi_misi');
    }
}
