<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penggunas = [
            [
                'namaPengguna' => 'adi',
                'namaLengkap' => 'female',
                'jenisKelamin' => 'asu',
                'tanggalLahir' => 1994-10-07,
                'email' => 'tes2@email.com',
                'sandi' => 'Graduated',
                'noHp' => 20125,
                'token' => '',
            ],
            [
                'namaPengguna' => 'asdfa',
                'namaLengkap' => 'male',
                'jenisKelamin' => 'aaaaasu',
                'tanggalLahir' => 1994-10-07,
                'email' => 'tes222@email.com',
                'sandi' => 'Graduated',
                'noHp' => 20125,
                'token' => '',          
            ]
        ];

        foreach ($penggunas as $pengguna)
            DB::table('pengguna')->insert($pengguna);
    }
}
