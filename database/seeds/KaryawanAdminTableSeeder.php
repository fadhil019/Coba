<?php

use Illuminate\Database\Seeder;
use App\KaryawanAdmin;
use Faker\Factory as Faker;

class KaryawanAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        KaryawanAdmin::insert([
            'nama' => $faker->name,
            'jabatan' => 'Kepala',
            'bagian' => rand(1, 3),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        KaryawanAdmin::insert([
            'nama' => $faker->name,
            'jabatan' => 'Wakil',
            'bagian' => rand(1, 3),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        for ($i=1; $i <= 20 ; $i++) { 
            KaryawanAdmin::insert([
                'nama' => $faker->name,
                'jabatan' => 'Karyawan',
                'bagian' => rand(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
