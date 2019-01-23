<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class skillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$skills = [
			[
				'name' => 'Blender Animation',
				'description' => 'Untuk memblender/menggerakkan gambar',
				'major_id' => 2
			],
			[
				'name' => 'Blender Modeller',
				'description' => 'Untuk menggambar gambar 3D',
				'major_id' => 1
			],
			[
				'name' => 'HTML/CSS/JAVASCRIPT',
				'description' => 'Text Editor untuk code',
				'major_id' => 4
			],
			[
				'name' => 'Autodesk Maya',
				'description' => 'membuat gambar 3d modeller',
				'major_id' => 1
			],
			[
				'name' => 'Adobe Illustrator',
				'description' => 'Untuk gambar menggambar/vector',
				'major_id' => 3
			],
			[
				'name' => 'Postman',
				'description' => 'Untuk test disisi backend',
				'major_id' => 4
			]
		];

		foreach ($skills as $skill)
			DB::table('skills')->insert($skill);
    }
}
