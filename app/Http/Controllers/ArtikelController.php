<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artikel;
use Illuminate\Support\Facades\File;

class ArtikelController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    public function get(Request $request) {
        
        $artikel = Artikel::all();
        
        return response()->json($artikel);
    }

    public function getById($id) {
        $artikel = Artikel::find($id);

        if($artikel){

            $response['result'] = $artikel;

            return response()->json($response, 200);
        }

        $response = [
                        'status' => 'Error',
                        'message' => 'Kategori with id ' . $id . ' Not Found'
                    ];
        
        return response()->json($response, 404);
    }

    public function create(Request $request) {
        $artikel = $request->all();
        
        if($artikel == null) {
            
            $response = [
                'status' => 'Error',
                'message' => 'Please fill the empty blank'
            ];

            return response()->json($response, 403);
        } else {
            $artikel = new Artikel;
            $artikel->judul = $request->input('judul');
            $artikel->artikel = $request->input('artikel');
            $artikel->gambar = $request->input('gambar');
            $artikel->save();
        
            $response['status'] = 'Success';
            $response['message'] = 'New artikel Submitted';
        
            return response()->json($response, 200);
        }
    }

    public function update(Request $request, $id) {
        
        $inputan =$request->all();

        $artikel = Artikel::find($id);

        if($artikel == null) {
            $response = [
                'status' => 'Forbidden',
                'messages' => 'Id is not exist',
            ];
            
            return response()->json($response, 403);
        } else {

            $artikel->update([
                                'judul' => $inputan['judul'],
                                'artikel' => $inputan['artikel'],
                                'gambar' => $inputan['gambar'],
                            ]);

            $response = [
            'status' => 'Success',
            'messages' => 'Artikel updated',
            'result' => $artikel
            ];
            
            return response()->json($response);
        }
    }

    public function delete(Request $request, $id) {
        $response = [
            'status'=> null,
            'message'=> null
        ];

        $inputan = $request->all();

        $artikel = Artikel::find($id);

        if ($artikel) {
            Artikel::where('id',$id)->delete();
            $response['status'] = 'Success';
            $response['message'] = 'Kategori with title '.$artikel->judul.' deleted';
            
            return response()->json($response);
        } else {
            $response['status'] = 'Error';
            $response['message'] = 'Kategori with id ' . $id . ' Not Found';
            
            return response()->json($response, 404);
        }
    }
}

