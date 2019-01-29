<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Founder;
use Illuminate\Support\Facades\File;

class FounderController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function get(Request $request){
		
		$founder = Founder::all();
		
		return response()->json($founder);
	}

	public function create(Request $request){
		$founder = $request->all();
		
		if($founder == null) {
			$response['status'] = 'Error';
			$response['message'] = 'Please fill the empty blank';

			return response()->json($response, 403);
		} else {
			$founder = new Founder;
			$founder->description = $request->input('description');
			$founder->save();
		
			$response['status'] = 'Success';
			$response['message'] = 'New founder Submitted';
		
			return response()->json($response, 200);
		}
	}

	public function update(Request $request, $id) {
		
		$inputan =$request->all();

		$founder = Founder::find($id);

		if($founder == null) {
			$response = [
			'status' => 'Forbidden',
			'messages' => 'Id is not exist',
			];
			
			return response()->json($response, 403);
		} else {

			$founder->update(['description' => $inputan['description'],
								'file' => $inputan['file'],
							]);

			$response = [
			'status' => 'Success',
			'messages' => 'Founder updated',
			'result' => $founder
			];
			
			return response()->json($response);
		}
	}
}

