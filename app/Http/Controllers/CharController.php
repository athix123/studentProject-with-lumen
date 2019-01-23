<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Skill;
use App\Major;
use App\Character;

class CharacterController extends Controller
{
	public function __construct(){
		// $this->middleware('auth');
	}

	public function all(Request $request){
		$query = $request->query();
		if ($query) {
			if ($query['withDeleted'] == 'true') {
				$char = Character::withTrashed()->get();
			} 
		} else {
			$char = Character::all();
		}
		return response()->json($char);
	}

	public function getById($id){
		$char = Character::find($id);
		if($char){
			$response['result'] = $char;

			return response()->json($response);
		}

		$response = ['status' => 'Error',
					'message' => 'Character with id ' . $id . ' Not Found'
					];
		
		return response()->json($response, 404);
	}

	public function create(Request $request){
		try{
	        $char = new Character;
			$char->name = $request->input('name');
			$char->description = $request->input('description');
			$char->save();

			$response['status'] = 'Success';
			$response['message'] = 'New Character Submitted';
			
			return response()->json($response);
	    }
	    catch (\Exception $e){
	        $error_code = $e->errorInfo[1];
	        if($error_code == 1062){
	            return 'You have a duplicate entry problem';
	        }
	    }
	}

	public function update(Request $request, $id) {
		$inputan = $request->all();

		$char = Character::find($id);

		if($char) {
			Character::where('id', $id);
			$char->name = $inputan['name'];
			$char->description = $inputan['description'];
			// $char->major_id = $inputan['major_id'];
			$char->save();
		
			$response['status'] = 'Success';
			$response['message'] = 'Character with name '. $char->name .' updated';
		
			return response()->json($response);
		} else {
			$response['status'] = 'Error';
			$response['message'] = 'Character with id ' . $id . ' Not Found';
		
			return response()->json($response, 404);
		}
	}

	public function delete(Request $request, $id) {
		$response = [
			'status'=> null,
			'message'=> null
		];

		$inputan = $request->all();

		$char = Character::find($id);

		if ($char) {
			Character::where('id',$id)->delete();
			$response['status'] = 'Success';
			$response['message'] = 'Character with name '.$char->name.' deleted';
			
			return response()->json($response);
		} else {
			$response['status'] = 'Error';
			$response['message'] = 'Character with id ' . $id . ' Not Found';
			
			return response()->json($response, 404);
		}
	}
}

