<?php

use Illuminate\Database\Seeder;
use App\Periode;
use Faker\Factory as Faker;

class PeriodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=1; $i <= 12 ; $i++) { 
            Periode::insert([
                'bulan' => $i,
                'tahun' => 2021,
                'id_users' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}
