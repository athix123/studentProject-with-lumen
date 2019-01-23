<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$students = [
			[
				'name' => 'adi',
				'gender' => 'female',
				'birthday' => '1994-10-07',
				'address' => 'jalan 1',
				'email' => 'tes2@email.com',
				'status' => 'Graduated',
				'major' => 2,
				'generations' => 2
			],
			[
				'name' => 'budi',
				'gender' => 'male',
				'birthday' => '1994-05-12',
				'address' => 'jalan 2',
				'email' => 'tes3@email.com',
				'status' => 'Graduated',
				'major' => 4,
				'generations' => 2			
			],
			[
				'name' => 'cahyono',
				'gender' => 'male',
				'birthday' => '1994-10-04',
				'address' => 'jalan 3',
				'email' => 'tes1@email.com',
				'status' => 'Graduated',
				'major' => 4,
				'generations' => 3				
			],
			[
				'name' => 'deni',
				'gender' => 'female',
				'birthday' => '1994-04-06',
				'address' => 'jalan 4',
				'email' => 'tes5@email.com',
				'status' => 'Graduated',
				'major' => 1,
				'generations' => 3
			],
			[
				'name' => 'edwin',
				'gender' => 'female',
				'birthday' => '1994-03-01',
				'address' => 'jalan 5',
				'email' => 'tes4@email.com',
				'status' => 'Graduated',
				'major' => 3,
				'generations' => 4
			]
		];

		foreach ($students as $student)
			DB::table('students')->insert($student);
    }
}
