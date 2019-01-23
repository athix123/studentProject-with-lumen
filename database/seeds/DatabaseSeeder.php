<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	skillTableSeeder::class,
        	StudentSkillSeeder::class,
        	StudentSeeder::class,
        	MajorSeeder::class,
            CharTableSeeder::class,
            StudentCharTableSeeder::class,
            OurWorkSeeder::class
        ]);
    }
}
