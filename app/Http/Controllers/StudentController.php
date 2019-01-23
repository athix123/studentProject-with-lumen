<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Skill;
use App\Studentskill;
use App\Major;
use App\Character;
use App\StudentChar;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
	public function __construct(){
		// $this->middleware('auth');
	}

	public function all(Request $request){

		$query = $request->query();
		if ($query) {
			if ($query['withDeleted'] == 'true') {
				$students = Student::withTrashed()->get();
			} 
		} else {
			$students = Student::all();
		}
		return response()->json($students);
	}

	public function getById($id){

		// $student = Student::select(
		// 			'students.id as id',
		// 			'students.name as name',
		// 			'students.status as status',
		// 			'major.id as major_id',
		// 			'major.name as major',
		// 			'skills.id as skill_id',
		// 			'skills.name as skill',
		// 			'skills.description as description',
		// 			'student_skills.score as score'
		// 		)
		// 		->leftJoin('student_skills','student_skills.student_id', '=', 'students.id')
		// 		->leftJoin('major', 'major.id', '=', 'students.major')
		// 		->leftJoin('skills', 'skills.id', '=', 'student_skills.skill_id')
		// 		->where('students.id', $id)
		// 		->get();

		// return response()->json(['data'=>$student[0],'skill'=>[['name'=>'blender'],['name'=>'photoshop']]]);

		$student = Student::find($id);
		
		if($student) {
		
			$skill = Studentskill::where('student_id', $id)
					->join('skills', 'skills.id', '=', 'student_skills.skill_id') 
					->get();

			$character = StudentChar::where('student_id', $id)
					->join('karakter', 'karakter.id', '=', 'student_char.char_id')
					->get();

			$student->skills = $skill;
			$student->characters = $character;

			return response()->json($student);
		}

		$response['status'] = 'Error';
		$response['message'] = 'Student with id ' .$id. ' Not Found';
		
		return response()->json($response, 404);
					
		// $data = ['data' => $student, 'skills' => $skill];
	}

	public function getStudentSkill($id){

		// $data = Student::find($id)
		// 		->join('student_skills','student_skills.id','=','students.id')
		// 		->where('student_id', $id)
		// 		->get();

		// $data2 = Studentskill::where('student_id', $id)
		// 		->join('students','students.id','=','student_skills.student_id')
		// 		->get();

		$student = Student::find($id);
					
		$skill = Studentskill::find($id)
				->where('student_id', $id)
				->join('skills', 'skills.id', '=', 'student_skills.skill_id') 
				->get();

		$student->skills = $skill;

		return response()->json($student);
	}

	public function getStudentChar($id){
		$student = Student::find($id);

		$character = StudentChar::find($id)
				->where('student_id', $id)
				->join('karakter', 'karakter.id', '=', 'student_char.char_id')
				->get();

		$student->character = $character;

		// var_dump($data2);
		return response()->json($student);
	}

	public function getStudentMajor($id){
		$data = Student::find($id)
				->where('major', $id)
				->join('major','major.id','=','students.major')
				->select(
						'students.id as StudentId',
						'students.name as StudentName',
						'students.major as MajorId',
						//'major.major_id',
						'major.name as Major Name',
						'major.description as Major desc'
						)
				//->join('major', 'major.id', '=', 'major.id')
				->get();

		//$data2 = Skill::where('major_id', $id)
		//		->get();

		return response()->json($data);
	}

	public function create(Request $request){
		
		$inputan = $request->all();

		$student = new Student;
		$student->name = $inputan['name'];
		$student->gender = $inputan['gender'];		
		$student->birthday = $inputan['birthday'];
		$student->address = $inputan['address'];
		$student->email = $inputan['email'];
		$student->status = $inputan['status'];
		$student->major = $inputan['major'];
		$student->generations = $inputan['generations'];
		$student->profile_picture = $inputan['profile_picture'];

		$student->save();
		// ========================================================
		$i = 0;
 		foreach ($inputan['skills'] as $key => $value) {
			// print $key;
			// print $value;
			// var_dump($value);
			$student_skill = new Studentskill;
			$student_skill->student_id = $student['id'];
			$student_skill->skill_id = $inputan['skills'][$i]['id'];
			$student_skill->score = $inputan['skills'][$i]['score'];
			$student_skill->save();

			$i = $i+1;
		}

		// ========================================================
		$i = 0;
		foreach ($inputan['characters'] as $key => $value) {
			$student_char = new StudentChar;
			$student_char->student_id = $student['id'];
			$student_char->char_id = $inputan['characters'][$i]['id'];
			$student_char->score = $inputan['characters'][$i]['score'];
			$student_char->save();

			$i = $i+1;	
		}

		if($student == null) {
			$response = [
			'status' => 'Forbidden',
			'messages' => 'Id is not exist',
			];
			
			return response()->json($response, 403);
		} else {
			$response = [
				'status' => 'Success',
				'messages' => 'New Student Submitted',
			];

			return response()->json($response, 200);
		}
	}

	public function update(Request $request, $id) {
		$inputan = $request->all();

		$data = Student::find($id);
		$data->name = $inputan['name'];
		$data->gender = $inputan['gender'];		
		$data->birthday = $inputan['birthday'];
		$data->address = $inputan['address'];
		$data->email = $inputan['email'];
		$data->status = $inputan['status'];
		$data->major = $inputan['major'];
		$data->generations = $inputan['generations'];

		$data->save();

		$i = 0;
 		foreach ($inputan['skills'] as $key => $value) {
 			// print $key;
 			// print $value;
 			// var_dump($value);
			$student_skill = Studentskill::where('student_id', $id)
							->where('skill_id', $value['id'])
							->update(['score' => $value['score']]);

	 		$i = $i+1;
		}

		$i = 0;
 		foreach ($inputan['characters'] as $key => $value) {

			$student_skill = StudentChar::where('student_id', $id)
							->where('char_id', $value['id'])
							->update(['score' => $value['score']]);

	 		$i = $i+1;
		}

		$response = [
			'status' => 'Success',
			'messages' => 'Data has been updated'
		];

		return response()->json($response, 200);
	}

	public function delete(Request $request, $id) {
		$response = [
			'status'=> null,
			'message'=> null
		];

		$inputan = $request->all();

		$student = Student::find($id);

		if ($student) {
			Student::where('id',$id)->delete();
			$response['status'] = 'Success';
			$response['message'] = 'Student with name '.$student->name.' deleted';
			
			return response()->json($response);
		} else {
			$response['status'] = 'Error';
			$response['message'] = 'Student with id ' . $id . ' Not Found';
			
			return response()->json($response, 404);
		}
	}

	public function postFile(Request $request) {
		
		if ($request->hasFile('profile_picture')) {
			$image = $request->file('profile_picture');
			$name = str_random(15).'.'.$image->getClientOriginalExtension();
			$path = 'images/';
			$image->move($path, $name);

			$response = [
			'status' => 'Success',
			'messages' => 'File uploaded',
			'url' => url().'/'.$path.$name,
			];

			return response()->json($response, 200); 
		} else {
			$response = [
			'status' => 'Error',
			'messages' => 'Failed to upload'
			];

			return response()->json($response, 403);
		}
	}

	public function updateFile(Request $request, $id) {

		$student = Student::find($id);

		if ($about == null) {

			$response = [
			'status' => 'Forbidden',
			'messages' => 'Id is not exist',
			];
			
			return response()->json($response, 403);
		
		} else if { ($request->hasFile('profile_picture')) {
			$image = $request->file('profile_picture');
			$name = str_random(15).'.'.$image->getClientOriginalExtension();
			$path = 'images/';
			$image->move($path, $name);

			File::delete($student->profile_picture);

			$student->profile_picture = $path .  $name;
			$student->save();

			$response = [
			'status' => 'Success',
			'messages' => 'File uploaded',
			'url' => url().'/'.$path.$name,
			];

			return response()->json($response, 200); 
		} else {
			$response = [
			'status' => 'Error',
			'messages' => 'Failed to upload'
			];

			return response()->json($response, 403);
		}
	}
}

