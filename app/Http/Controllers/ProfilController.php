<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function sejarah(){
        return view('user/profil.sejarah');
    }
    
    public function timGemar(){
        return view('user/profil.team');
    }

    public function StrukturOrganisasi(){
        return view('user/profil.strukturorganisasi');
    }

    public function visimisi(){
        return view('user/profil.visi_misi');
    }
}
