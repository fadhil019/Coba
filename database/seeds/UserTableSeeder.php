<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        User::insert([
            'username' => 'admin',
            'nama_user' => 'Administrator',
            'bagian' => 'Admin sistem',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::insert([
            'username' => 'admin_remu',
            'nama_user' => $faker->name,
            'bagian' => 'Admin remunerasi',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::insert([
            'username' => 'admin_ruangan',
            'nama_user' => $faker->name,
            'bagian' => 'Admin ruangan',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::insert([
            'username' => 'kolektif_data',
            'nama_user' => $faker->name,
            'bagian' => 'Kolektif data',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::insert([
            'username' => 'manajemen_remu',
            'nama_user' => $faker->name,
            'bagian' => 'Manajemen remunerasi',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::insert([
            'username' => 'penunjang',
            'nama_user' => $faker->name,
            'bagian' => 'Penunjang remunerasi',
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        for ($i=1; $i <= 12 ; $i++) { 
            User::insert([
                'username' => 'perawat'.$i,
                'nama_user' => $faker->name,
                'bagian' => 'Perawat remunerasi',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
