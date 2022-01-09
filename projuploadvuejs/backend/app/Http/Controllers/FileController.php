<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    //

    public function uploadFile(Request $request){

        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'erro'=> 'Arquivo Invalido',
                'sucesso'=>'',
                'urlfile'=> '']);
        }

        //dd($request);

        //Recuperando arquivo e salvando na pasta media da pasta public
        $file = $request->file('file');
        $path = $file->store('media', 'public'); //salva arquivo e recupera o path

        return response()->json(
                ['erro'=> '',
                 'sucesso'=>'Arquivo enviado com sucesso',
                 'urlfile' => url('/').Storage::url($path)
                ]);
        
    }
}
