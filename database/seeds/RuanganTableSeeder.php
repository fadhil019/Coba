<?php

use Illuminate\Database\Seeder;
use App\Ruangan;
use Faker\Factory as Faker;

class RuanganTableSeeder extends Seeder
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
            Ruangan::insert([
                'nama_ruangan' => $faker->lastName,
                'kategori_ruangan' => 'IGD',
                'id_users' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
