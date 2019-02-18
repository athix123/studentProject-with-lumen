<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TentangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tentangs = [
			[
				'deskripsi' => 'adi',
				'gambar' => 'female'
			]
		];

		foreach ($tentangs as $tentang)
			DB::table('tentang')->insert($tentang);
    }
}
