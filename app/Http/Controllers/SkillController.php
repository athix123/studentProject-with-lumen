<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Skill;
use App\Major;
use App\Studentskill;

class SkillController extends Controller
{
	public function __construct(){
		// $this->middleware('auth');
	}

	public function all(Request $request){
		$query = $request->query();

		if ($query) {

			if ($query['withDeleted'] == 'true') {
				# code...
				$skill = Skill::withTrashed()->get();
			} else {
				# code...
			}
			
			# code...

		} else {
			# code...
			$skill = Skill::all();
		}
		
		return response()->json($skill);

	}

	public function getById($id) {
		$skill = Skill::find($id);

		if($skill){

			$response['result'] = $skill;

			return response()->json($response);
		}

		$response['status'] = 'Error';
		$response['message'] = 'Skill with id ' .$id. ' Not Found';
		
		return response()->json($response, 404);
	}
	
	public function getByMajorId($id) {
		
		$skill = Skill::where('major_id',$id)->select('major_id','id as idSkill','name','description')->get();
			
			if($skill !== null) {
				
				$response['result'] = $skill;

				return response()->json($response, 200);
			}

			$response['status'] = 'Error';
			$response['message'] = 'Skill with Major' .$id. ' not found!';

		return response()->json($response, 404);
	}

	public function create(Request $request){

		try {

	      	$skill = new Skill;
			$skill->name = $request->input('name');
			$skill->description = $request->input('description');
			$skill->major_id = $request->input('major_id');
			$skill->save();
			
			$response = [
				'status' => 'Success',
				'messages' => 'New Skill Created'
			];

			return response()->json($response, 200);
	    	
	   } catch (\Exception $e){
	      
	        $error_code = $e->errorInfo[1];
	      
	        if($error_code == 1062){

	        	$response = [
				'status' => 'Error',
				'messages' => 'You have a duplicate entry problem'
				];
	      
	            return response()->json($response, 400);
	        }
    	}
	}

	public function update(Request $request, $id) {
		$inputan = $request->all();
		
		try {

			$skill = Skill::find($id);

			if($skill) {

				Skill::where('id', $id);
				$skill->name = $inputan['name'];
				$skill->description = $inputan['description'];
				$skill->major_id = $inputan['major_id'];
				$skill->save();
			
				$response['status'] = 'Success';
				$response['message'] = 'skill with name '. $skill->name .' updated';
			
				return response()->json($response);
			
			} else {
			
				$response['status'] = 'Error';
				$response['message'] = 'skill with id ' . $id . ' Not Found';
			
				return response()->json($response, 404);
			}

		} catch (\Exception $e){
	    
	        $error_code = $e->errorInfo[1];
	    
	        if($error_code == 1062){

	        	$response = [
				'status' => 'Error',
				'messages' => 'You have a duplicate entry problem'
				];
	    
	            return response()->json($response, 400);
	        }
    	}
	}

	public function delete(Request $request, $id) {
		$response = [
			'status'=> null,
			'message'=> null
		];

		$inputan = $request->all();

		$skill = Skill::find($id);

		if ($skill) {

			Skill::where('id',$id)->delete();
			$response['status'] = 'Success';
			$response['message'] = 'Skill with name '.$skill->name.' deleted';
			
			return response()->json($response);
		
		} else {
		
			$response['status'] = 'Error';
			$response['message'] = 'Skill with id ' . $id . ' Not Found';
			
			return response()->json($response, 404);
		}
	}
}

