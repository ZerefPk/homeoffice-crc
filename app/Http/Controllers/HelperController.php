<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anexo;

class HelperController extends Controller
{
    //
    public function consultarAnexo($id, $name){

        $data = Anexo::where('id', $id)->where('name', $name)->first();

        //dd($data);
        return \Storage::download('anexos/'.$data->path, $name);
        //$path = $data->path;

        //return view('exibe-pdf', compact('path'));
        
    }
}
