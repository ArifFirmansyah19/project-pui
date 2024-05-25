<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaPersebaranUmkmController extends Controller
{
    public function index(){
        return view('peta.maps');
    }
}
