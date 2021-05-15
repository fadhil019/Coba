<?php

use Illuminate\Database\Seeder;
use App\DataPasien;
use Faker\Factory as Faker;

class DataPasienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=1; $i <= 5; $i++) { 
            DataPasien::insert([
                'no_sep' => rand(12345, 67890),
                'user_kasir' => $faker->lastName,
                'tgl_masuk' => date('d-m-Y'),
                'tgl_keluar' => date('d-m-Y'),
                'no_rm' => $i,
                'nama_pasien' => $faker->firstName,
                'penjamin' => $faker->firstName,
                'reg_type' => 'Rawat Inap',
                'nama_dokter_perawat' => $faker->firstName,
                'kategori_ruangan' => 'Rawat Inap',
                'deskripsi_tindakan' => 'colaai',
                'jp' => 0,
                'id_users' => 1,
                'id_periode' => 1,
                'id_ruangan' => 1,
                'id_dpjp' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
