<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tentang;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use GrahamCampbell\Flysystem\Facades\Flysystem;

class TentangController extends Controller
{
	public function __construct(){
		// $this->middleware('auth');
	}

	public function get(Request $request){

		$tentang = Tentang::all();
		
		return response()->json($tentang, 200);
	}

	public function create(Request $request){
		$tentang = $request->all();
		
		if($tentang == null) {
			$response['status'] = 'Error';
			$response['message'] = 'Please fill the empty blank';

			return response()->json($response, 403);
		} else {
			$tentang = new Tentang;
			$tentang->deskripsi = $request->input('deskripsi');
			$tentang->gambar = $request->input('gambar');
			$tentang->save();
		
			$response['status'] = 'Success';
			$response['message'] = 'New tentang Submitted';
		
			return response()->json($response, 200);
		}
	}

	public function update(Request $request, $id) {
		
		$inputan =$request->all();

		$tentang = Tentang::find($id);

		if($tentang == null) {
			$response = [
			'status' => 'Forbidden',
			'messages' => 'Id is not exist',
			];
			
			return response()->json($response, 403);
		} else {

			$tentang->update(['deskripsi' => $inputan['deskripsi'],
							'gambar' => $inputan['gambar']]);

			$response = [
			'status' => 'Success',
			'messages' => 'tentang updated',
			'result' => $tentang
			];
			
			return response()->json($response, 200);
		}
	}
}
