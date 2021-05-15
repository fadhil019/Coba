<?php

use Illuminate\Database\Seeder;
use App\KategoriTindakan;
use Faker\Factory as Faker;

class KategoriTindakanTableSeeder extends Seeder
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
           KategoriTindakan::insert([
                'nama' => $faker->lastName,
                'kategori_data' => 'Penunjang',
                'tahapan_proses' => 'Proses '.rand(3,4),
                'id_users' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
