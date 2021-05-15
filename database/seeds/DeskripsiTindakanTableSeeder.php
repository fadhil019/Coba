<?php

use Illuminate\Database\Seeder;
use App\DeskripsiTindakan;
use Faker\Factory as Faker;

class DeskripsiTindakanTableSeeder extends Seeder
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
            DeskripsiTindakan::insert([
                'deskripsi_tindakan' => $faker->lastName,
                'id_kategori_tindakan' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
