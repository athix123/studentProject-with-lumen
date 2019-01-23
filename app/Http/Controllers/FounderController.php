<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Founder;
use Illuminate\Support\Facades\File;

class FounderController extends Controller
{
	public function __construct(){
		// $this->middleware('auth');
	}

	public function get(Request $request){
		
		$founder = Founder::all();
		
		return response()->json($founder);
	}

	public function updatedesc(Request $request, $id) {
		
		$inputan =$request->all();

		$founder = Founder::find($id);

		if($founder == null) {
			$response = [
			'status' => 'Forbidden',
			'messages' => 'Id is not exist',
			];
			
			return response()->json($response, 403);
		} else {

			$founder->update(['description' => $inputan['description']]);

			$response = [
			'status' => 'Success',
			'messages' => 'Founder updated',
			'result' => $founder
			];
			
			return response()->json($response);
		}
	}

	public function updatefile(Request $request, $id) {

		$founder = Founder::find($id);

		if ($founder == null) {

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
		
			File::delete($founder->file); 
			
			$founder->file = $path . $fileName;

			$response = [
			'status' => 'Success',
			'messages' => 'File uploaded',
			'url' => url().'/'.$path.$fileName,
			];
		} 
	
		$founder->save();
	
		return response()->json($response, 200); 
	}
}

