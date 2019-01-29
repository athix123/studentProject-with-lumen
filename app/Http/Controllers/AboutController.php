<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use GrahamCampbell\Flysystem\Facades\Flysystem;

class AboutController extends Controller
{
	public function __construct(){
		// $this->middleware('auth');
	}

	public function get(Request $request){

		$about = About::all();
		
		return response()->json($about, 200);
	}

	public function create(Request $request){
		$about = $request->all();
		
		if($about == null) {
			$response['status'] = 'Error';
			$response['message'] = 'Please fill the empty blank';

			return response()->json($response, 403);
		} else {
			$about = new About;
			$about->description = $request->input('description');
			$about->save();
		
			$response['status'] = 'Success';
			$response['message'] = 'New about Submitted';
		
			return response()->json($response, 200);
		}
	}

	public function update(Request $request, $id) {
		
		$inputan =$request->all();

		$about = About::find($id);

		if($about == null) {
			$response = [
			'status' => 'Forbidden',
			'messages' => 'Id is not exist',
			];
			
			return response()->json($response, 403);
		} else {

			$about->update(['description' => $inputan['description'],
							'file' => $inputan['file']]);

			$response = [
			'status' => 'Success',
			'messages' => 'About updated',
			'result' => $about
			];
			
			return response()->json($response, 200);
		}
	}
}
