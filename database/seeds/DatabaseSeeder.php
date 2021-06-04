<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(UserTableSeeder::class);
        $this->call(PeriodeTableSeeder::class);
        // $this->call(DataKeuanganPasienTableSeeder::class);
        // $this->call(RuanganTableSeeder::class);
        // $this->call(KategoriTindakanTableSeeder::class);
        // $this->call(DeskripsiTindakanTableSeeder::class);
        // $this->call(DokterTableSeeder::class);
        // $this->call(KaryawanTableSeeder::class);
        // $this->call(DataPasienTableSeeder::class);
        // $this->call(KaryawanAdminTableSeeder::class);
        // $this->call(KaryawanPenunjangTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}
