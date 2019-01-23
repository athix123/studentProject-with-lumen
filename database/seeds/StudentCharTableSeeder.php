<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentCharTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$studentChars = [
			[
				'student_id' => 4,
				'char_id' => 1,
				'score' => 90				
			],
			[
				'student_id' => 4,
				'char_id' => 5,
				'score' => 30				
			],
			[
				'student_id' => 1,
				'char_id' => 1,
				'score' => 20				
			],
			[
				'student_id' => 2,
				'char_id' => 2,
				'score' => 40
			],
			[
				'student_id' => 3,
				'char_id' => 5,
				'score' => 62
			],
			[
				'student_id' => 5,
				'char_id' => 4,
				'score' => 74
			]
		];

		foreach ($studentChars as $studentChar)
			DB::table('student_char')->insert($studentChar);
    }
}