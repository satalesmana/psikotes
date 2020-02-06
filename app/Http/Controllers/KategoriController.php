<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(Request $reques){
    //    $users = DB::select('select * from users where active = ?', [1]);
    //    return view('user.index', ['users' => $users]);

    //    foreach ($users as $user) {
    //       echo $user->name;
    //   }

        $kategori = Kategori::all();

        return $kategori;
    }

    public function store(Request $request)
    {
        $kategori = Kategori::create($request->all());        

        $return = [
            'succes' => true,
            'data' => $kategori,
            'message' => 'Data has bee saved'
        ];
    }

    
}
