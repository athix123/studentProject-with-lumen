<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$studentSkills = [
			[
				'student_id' => 4,
				'skill_id' => 1,
				'score' => 50				
			],
			[
				'student_id' => 2,
				'skill_id' => 5,
				'score' => 70				
			],
			[
				'student_id' => 1,
				'skill_id' => 1,
				'score' => 60				
			],
			[
				'student_id' => 2,
				'skill_id' => 2,
				'score' => 80
			],
			[
				'student_id' => 3,
				'skill_id' => 5,
				'score' => 80
			],
			[
				'student_id' => 5,
				'skill_id' => 4,
				'score' => 99
			]
		];

		foreach ($studentSkills as $studentSkill)
			DB::table('student_skills')->insert($studentSkill);
    }
}
