<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$chars = [
			[
				'name' => 'Creative',
				'description' => 'Kreatif'
			],
			[
				'name' => 'Innovative',
				'description' => 'Inovasi'
			],
			[
				'name' => 'Responsible',
				'description' => 'responsif'
			],
			[
				'name' => 'Communicative',
				'description' => 'Komunikasi'
			],
		];

		foreach ($chars as $char)
			DB::table('karakter')->insert($char);
    }
}