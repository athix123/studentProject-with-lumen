<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OurWork;
use Illuminate\Support\Facades\File;

class OurWorkController extends Controller
{
	public function __construct(){
		// $this->middleware('auth');
	}

	public function get(Request $request){
		$ourWork = OurWork::all();
		
		try {
			$ourWork = OurWork::all();
			
			return response()->json($ourWork);
		
		} catch (Exception $e) {
		
		}
	}

	public function getById(Request $request, $id) {
		$ourWork = OurWork::find($id);
		if($ourWork == null) {
			$response = [
			'status' => 'Forbidden',
			'message' => 'Id is not exist'
			];

			return response()->json($response, 403);
		}
		
		$response['result'] = $ourWork;

		return response()->json($response, 200);
	}

	public function create(Request $request){
		
		try {
			$inputan = $request->all();

			if($inputan == null) {
				$response = [
				'status' => 'Forbidden',
				'message' => 'Please fill the blank column'
				];
			
				return response()->json($response, 403);
				
			} else {

				$ourWork = new OurWorK;
				$ourWork->category = $inputan['category'];
				$ourWork->title = $inputan['title'];
				$ourWork->url_website = $inputan['url_website'];
				$ourWork->file = $inputan['file'];
				$ourWork->save();	
							
				$response = [
					'status' => 'Success',
				 	'message' => 'Our Work created',
				];
				
				return response()->json($response, 200);
			}

		} catch (\Illuminate\Database\QueryException $e) {
		  
		    if($e->getCode() === '23000') {
				
				$response = [
					'status' => 'Failed',
					'message' => 'Duplicate data ourWork',
				];
				
				return response()->json($response, 400);
		    }
		}

	}

	public function update(Request $request, $id) {

		$inputan = $request->all();

		$ourWork = OurWork::find($id);

		if ($inputan == null) {
		
			$response = [
			'status' => 'Forbidden',
			'message' => 'Please fill the blank column'
			];
		
			return response()->json($response, 403);

		} else {
			
			$ourWork->update(['category' => $inputan['category'],
							'title' => $inputan['title'],
							'url_website' => $inputan['url_website'],
							'file' => $inputan['file']
							]);

			$response = [
			'status' => 'Success',
			'messages' => 'Our Work with id '. $id .' updated',
			];

			$ourWork->save();			
				
			return response()->json($response, 200);
		}
	}

	public function delete(Request $request, $id) {
		$response = [
			'status'=> null,
			'message'=> null
		];

		$ourWork = OurWork::find($id);

		File::delete($ourWork->file);

		if ($ourWork) {

			OurWork::where('id',$id)->delete();

			$response = ['status' => 'Success',
						'message' => 'Our Work with id '.$id.' deleted'
						];
			
			return response()->json($response);

		} else {

			$response = ['status' => 'Error',
						'message' => 'Our Work with id '.$id.' Not Found'
						];
			
			return response()->json($response, 404);
		}
	}
}

