<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $majors = [
			[
				'name' => '3D Modeller',
				'description' => '3D Modeller'
			],
			[
				'name' => 'Animator',
				'description' => 'Animator'	
			],
			[
				'name' => 'Compossitor',
				'description' => 'Compossitor'
			],
			[
				'name' => 'Programmer',
				'description' => 'Programmer'
			],
		];

		foreach ($majors as $major)
			DB::table('major')->insert($major);
    }
}
