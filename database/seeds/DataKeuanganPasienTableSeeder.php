<?php

use Illuminate\Database\Seeder;
use App\DataKeuanganPasien;
use Faker\Factory as Faker;

class DataKeuanganPasienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 12 ; $i++) { 
            for ($j=1; $j <= 12 ; $j++) { 
                DataKeuanganPasien::insert([
                    'no_sep_keuangan_pasien' => rand(11111, 99999),
                    'nominal_uang' => rand(11111, 99999),
                    'id_periode' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
