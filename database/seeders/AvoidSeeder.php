<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AvoidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avoids = [
            ['name' => 'Pedas', 'disease_id' => 1],
            ['name' => 'Asam', 'disease_id' => 1],
            ['name' => 'Berlemak', 'disease_id' => 1],
            ['name' => 'Gula', 'disease_id' => 2],
            ['name' => 'Makanan Cepat Saji', 'disease_id' => 2],
            ['name' => 'Makanan Berminyak', 'disease_id' => 2],
            ['name' => 'Kafein', 'disease_id' => 3],
            ['name' => 'Alkohol', 'disease_id' => 3],
            ['name' => 'Gula Berlebih', 'disease_id' => 3],
            ['name' => 'Kafein', 'disease_id' => 4],
            ['name' => 'Makanan Berat', 'disease_id' => 4],
            ['name' => 'Gula', 'disease_id' => 4],
            ['name' => 'Makanan Asam', 'disease_id' => 5],
            ['name' => 'Makanan Pedas', 'disease_id' => 5],
            ['name' => 'Kafein', 'disease_id' => 5],
            ['name' => 'Gula', 'disease_id' => 6],
            ['name' => 'Garam Berlebih', 'disease_id' => 6],
            ['name' => 'Makanan Berlemak', 'disease_id' => 6],
            ['name' => 'Makanan Dingin', 'disease_id' => 7],
            ['name' => 'Minuman Bersoda', 'disease_id' => 7],
            ['name' => 'Alkohol', 'disease_id' => 7],
            ['name' => 'Makanan Pedas', 'disease_id' => 8],
            ['name' => 'Minuman Dingin', 'disease_id' => 8],
            ['name' => 'Makanan Berminyak', 'disease_id' => 8],
            ['name' => 'Makanan Pedas', 'disease_id' => 9],
            ['name' => 'Gula', 'disease_id' => 9],
            ['name' => 'Makanan Berlemak', 'disease_id' => 9],
            ['name' => 'Makanan Berlemak', 'disease_id' => 10],
            ['name' => 'Makanan Dingin', 'disease_id' => 10],
            ['name' => 'Gula', 'disease_id' => 10],
            ['name' => 'Makanan Pedas', 'disease_id' => 11],
            ['name' => 'Makanan Asam', 'disease_id' => 11],
            ['name' => 'Gula', 'disease_id' => 11],
            ['name' => 'Makanan Pedas', 'disease_id' => 12],
            ['name' => 'Makanan Asam', 'disease_id' => 12],
            ['name' => 'Bubuk Susu', 'disease_id' => 12],
            ['name' => 'Makanan Pedas', 'disease_id' => 13],
            ['name' => 'Makanan Berlemak', 'disease_id' => 13],
            ['name' => 'Asam', 'disease_id' => 13],
            ['name' => 'Makanan Asam', 'disease_id' => 14],
            ['name' => 'Gula Berlebih', 'disease_id' => 14],
            ['name' => 'Kafein', 'disease_id' => 14],
            ['name' => 'Garam Berlebih', 'disease_id' => 15],
            ['name' => 'Gula', 'disease_id' => 15],
            ['name' => 'Makanan Berlemak', 'disease_id' => 15],
            ['name' => 'Makanan Pedas', 'disease_id' => 16],
            ['name' => 'Makanan Asam', 'disease_id' => 16],
            ['name' => 'Gula', 'disease_id' => 16],
        ];

        DB::table('avoids')->insert($avoids);
    }
}
