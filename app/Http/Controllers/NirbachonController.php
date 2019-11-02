<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NirbachonController extends Controller
{
    public function create()
    {
        return view('nirbachon.index');
    }

    public function search()
    {
        return view('nirbachon.search');
    }
}
