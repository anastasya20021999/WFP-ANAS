<?php

use Illuminate\Database\Seeder;

class MastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masters')->insert([
            'nama' => 'Makanan',
            'jenis' => 'pemasukkan',
            'user_id' => 2
           ]);
         DB::table('masters')->insert([
            'nama' => 'Uang Saku',
            'jenis' => 'pemasukkan',
            'user_id' => 2
           ]);
    }
}
