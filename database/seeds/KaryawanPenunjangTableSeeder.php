<?php

use Illuminate\Database\Seeder;
use App\KaryawanPenunjang;
use Faker\Factory as Faker;

class KaryawanPenunjangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        KaryawanPenunjang::insert([
            'nama' => $faker->name,
            'jabatan' => 'Kepala',
            'bagian' => rand(1, 6),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        KaryawanPenunjang::insert([
            'nama' => $faker->name,
            'jabatan' => 'Wakil',
            'bagian' => rand(1, 6),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        for ($i=1; $i <= 20 ; $i++) { 
            KaryawanPenunjang::insert([
                'nama' => $faker->name,
                'jabatan' => 'Karyawan',
                'bagian' => rand(1, 6),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
