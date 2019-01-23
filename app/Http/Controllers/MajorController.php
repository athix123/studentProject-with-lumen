<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Major;
use App\Skill;

class MajorController extends Controller
{
	public function __construct(){
		// $this->middleware('auth');
	}

	public function all(Request $request){
		// var_dump($request->query());
		
		// var_dump($query['withDeleted']);
		$query = $request->query();
		if ($query) {
			if ($query['withDeleted'] == 'true') {
				# code...
				$major = Major::withTrashed()->get();
			} else {
				# code...
			}
			
			# code...

		} else {
			# code...
			$major = Major::all();
		}
		return response()->json($major);
	}

	public function getMajorSkillById($id){

		$major = Major::select(
					'major.id as id',
					'major.name as major'
					)
				->join('skills','skills.major_id','=','major.id')
				->where('major_id', $id)
				->get();

		$result = [];
		foreach($major as $data){
			$result = [
				'major_id' => $data->id,
				'major' => $data->major,
				'skill' => $data->skill
			];
		}

		$major = Major::find($id);
		if($major == null) {
			$response = [
			'status' => 'Forbidden',
			'message' => 'Id is not exist'
			];

			return response()->json($response, 403);
		}
		
		$response['result'] = $result;

		return response()->json($result);
	}

	public function create(Request $request){
				
		try 
		{
			$major = $request->all();
			if($major == null) 
			{
				$response['status'] = 'Error';
				$response['message'] = 'Please fill the empty blank';

				return response()->json($response, 403);
			} 
			else 
			{
				$major = new Major;
				$major->name = $request->input('name');
				$major->description = $request->input('description');
				$major->save();
			
				$response['status'] = 'Success';
				$response['message'] = 'New Major Submitted';
			
				return response()->json($response, 200);
			}
		} catch (\Exception $e) {

			$error_code = $e->errorInfo[1];
			if($error_code == 1062) {
				
				$response['status'] = 'Failed';
				$response['message'] = 'You have a duplicate entry problem';

				return response()->json($response, 400);
			}
		}
	}

	public function update(Request $request, $id) {
		$inputan = $request->all();

		$major = Major::find($id);

		if($major) {
			Major::where('id', $id);
			$major->name = $inputan['name'];
			$major->description = $inputan['description'];
			$major->save();
		
			$response['status'] = 'Success';
			$response['message'] = 'Major with name '.$major->name.' updated';
		
			return response()->json($response, 200);
		} else {
			$response['status'] = 'Error';
			$response['message'] = 'Major with id ' . $id . ' Not Found';
		
			return response()->json($response, 404);
		}
	}

	public function delete(Request $request, $id) {
		$response = [
			'status'=> null,
			'message'=> null
		];

		$inputan = $request->all();

		$major = Major::find($id);

		if ($major) {
			Major::where('id',$id)->delete();
			$response['status'] = 'Success';
			$response['message'] = 'Major with name '.$major->name.' deleted';
			
			return response()->json($response, 200);
		} else {
			$response['status'] = 'Error';
			$response['message'] = 'Major with id ' . $id . ' Not Found';
			
			return response()->json($response, 404);
		}
	}
}