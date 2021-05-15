<?php

use Illuminate\Database\Seeder;
use App\Dokter;
use Faker\Factory as Faker;

class DokterTableSeeder extends Seeder
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
            Dokter::insert([
                'nama_dokter' => $faker->name,
                'bagian' => 'Umum',
                'id_users' => 1,
                'id_kategori_tindakan' => rand(1,12),
                'id_ruangan' => rand(1,12),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
