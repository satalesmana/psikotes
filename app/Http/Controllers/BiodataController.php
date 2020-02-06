<?php

namespace App\Http\Controllers;

use App\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index(Request $request){
        return view('biodata');
    }

    public function store(Request $request){
        $this->validate($request,[
            'nama' => 'required|min:5|max:30',
        ]);
        
        $biodata = new Biodata();
        $biodata->name = $request->nama;
        $biodata->save();

        return view('biodata');
    }
}
