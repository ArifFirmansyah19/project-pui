<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilAdminController extends Controller
{
    public function adminSejarah(){
        return view('admin/profil/sejarah.sejarahAdmin');
    }
    
    public function adminTimGemar(){
        return view('admin/profil/tim.timAdmin');
    }

    public function adminStrukturOrganisasi(){
        return view('admin/profil/strukturOrganisasi.strukturOrganisasi');
    }

    public function adminVisiMisi(){
        return view('admin/profil/visimisi.visiMisiAdmin');
    }
}
