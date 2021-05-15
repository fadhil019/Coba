<?php

use Illuminate\Database\Seeder;
use App\KaryawanPerawat;
use App\KaryawanPenunjang;
use App\KaryawanAdmin;
use Faker\Factory as Faker;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        KaryawanPerawat::insert([
            'nama' => 'Perawat'. $faker->name,
            'jabatan' => 'Kepala',
            'id_users' => 1,
            'id_ruangan' => rand(1,12),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        KaryawanPerawat::insert([
            'nama' => 'Perawat'.$faker->name,
            'jabatan' => 'Wakil',
            'id_users' => 1,
            'id_ruangan' => rand(1,12),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        for ($i=9; $i <= 29 ; $i++) { 
            KaryawanPerawat::insert([
                'nama' => 'Perawat'.$faker->name,
                'jabatan' => 'Karyawan',
                'id_users' => 1,
                'id_ruangan' => rand(1,12),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        KaryawanPenunjang::insert([
            'nama' => 'Penunjang'.$faker->name,
            'jabatan' => 'Kepala',
            'bagian' => rand(1,12),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        KaryawanPenunjang::insert([
            'nama' =>'Penunjang'. $faker->name,
            'jabatan' => 'Wakil',
            'bagian' => rand(1,12),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        for ($i=9; $i <= 29 ; $i++) { 
            KaryawanPenunjang::insert([
                'nama' => 'Penunjang'.$faker->name,
                'jabatan' => 'Karyawan',
                'bagian' => rand(1,12),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        KaryawanAdmin::insert([
            'nama' => 'Admin'.$faker->name,
            'jabatan' => 'Kepala',
            'bagian' => 'Admin rekam medis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        KaryawanAdmin::insert([
            'nama' => 'Admin'.$faker->name,
            'jabatan' => 'Wakil',
            'bagian' => 'Admin rekam medis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        for ($i=9; $i <= 29 ; $i++) { 
            KaryawanAdmin::insert([
                'nama' => 'Admin'.$faker->name,
                'jabatan' => 'Karyawan',
                'bagian' => 'Admin rekam medis',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        
    }
}
