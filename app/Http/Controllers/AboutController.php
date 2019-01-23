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

	public function updatedesc(Request $request, $id) {
		
		$inputan =$request->all();

		$about = About::find($id);

		if($about == null) {
			$response = [
			'status' => 'Forbidden',
			'messages' => 'Id is not exist',
			];
			
			return response()->json($response, 403);
		} else {

			$about->update(['description' => $inputan['description']]);

			$response = [
			'status' => 'Success',
			'messages' => 'About updated',
			'result' => $about
			];
			
			return response()->json($response, 200);
		}
	}

	public function updatefile(Request $request, $id) {

		$about = About::find($id);

		if ($about == null) {

			$response = [
			'status' => 'Forbidden',
			'messages' => 'Id is not exist',
			];
			
			return response()->json($response, 403);

		} elseif ($request->hasFile('file')) {

			$image = $request->file('file');
			$fileName = str_random(15).'.'.$image->getClientOriginalExtension();
			$path = 'images/';
			$image->move($path, $fileName);
		
			File::delete($about->file); 
			
			$about->file = $path . $fileName;

			$response = [
			'status' => 'Success',
			'messages' => 'File uploaded',
			'url' => url().'/'.$path.$fileName,
			];	
		}	

		$about->save();
		
		return response()->json($response); 
	}
}
