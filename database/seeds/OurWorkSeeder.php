<?php

use Illuminate\Database\Seeder;

class OurWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ourWorks = [
			[
				'category' => 'Web App',
				'title' => 'Wan Bogel',
				'url_website' => 'www.wan-bogel.crot',
				'file' => ''
			],
			[
				'category' => 'Web',
				'title' => 'Dicky Soekamdi',
				'url_website' => 'www.soekamdioye.unch',
				'file' => ''
			],
			[
				'category' => 'Web App',
				'title' => 'Travelogue',
				'url_website' => 'www.travelogue.crot',
				'file' => ''			
			]
		];

		foreach ($ourWorks as $ourWork)
		DB::table('our_works')->insert($ourWork);
    }
}
