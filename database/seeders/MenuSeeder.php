<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Seed the menus table with sample data.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            ['name' => 'Sate Ayam', 'favorite_id' => 1, 'allergy_id' => 1],
            ['name' => 'Ayam Goreng', 'favorite_id' => 1, 'allergy_id' => null],
            ['name' => 'Ayam Geprek', 'favorite_id' => 1, 'allergy_id' => null],
            ['name' => 'Opor Ayam', 'favorite_id' => 1, 'allergy_id' => null],
            ['name' => 'Ayam Betutu', 'favorite_id' => 1, 'allergy_id' => null],
            ['name' => 'Bebek Goreng', 'favorite_id' => 2, 'allergy_id' => null],
            ['name' => 'Bebek Betutu', 'favorite_id' => 2, 'allergy_id' => null],
            ['name' => 'Bebek Rica-Rica', 'favorite_id' => 2, 'allergy_id' => null],
            ['name' => 'Bebek Bakar', 'favorite_id' => 2, 'allergy_id' => null],
            ['name' => 'Nasi Goreng Bebek', 'favorite_id' => 2, 'allergy_id' => null],
            ['name' => 'Sup Ikan', 'favorite_id' => 3, 'allergy_id' => 3],
            ['name' => 'Pepes Ikan', 'favorite_id' => 3, 'allergy_id' => 3],
            ['name' => 'Ikan Goreng Tepung', 'favorite_id' => 3, 'allergy_id' => 2],
            ['name' => 'Ikan Asam Manis', 'favorite_id' => 3, 'allergy_id' => 3],
            ['name' => 'Sop Ikan Kakap', 'favorite_id' => 3, 'allergy_id' => 3],
            ['name' => 'Gulai Kambing', 'favorite_id' => 4, 'allergy_id' => 9],
            ['name' => 'Sate Kambing', 'favorite_id' => 4, 'allergy_id' => null],
            ['name' => 'Sop Kambing', 'favorite_id' => 4, 'allergy_id' => 9],
            ['name' => 'Tongseng Kambing', 'favorite_id' => 4, 'allergy_id' => 9],
            ['name' => 'Kambing Guling', 'favorite_id' => 4, 'allergy_id' => null],
            ['name' => 'Rendang Daging Sapi', 'favorite_id' => 5, 'allergy_id' => null],
            ['name' => 'Steak Sapi', 'favorite_id' => 5, 'allergy_id' => 9],
            ['name' => 'Sop Buntut', 'favorite_id' => 5, 'allergy_id' => null],
            ['name' => 'Daging Sapi Lada Hitam', 'favorite_id' => 5, 'allergy_id' => null],
            ['name' => 'Burger Daging Sapi', 'favorite_id' => 5, 'allergy_id' => 2],
            ['name' => 'Udang Saus Tiram', 'favorite_id' => 6, 'allergy_id' => 5],
            ['name' => 'Kerupuk Udang', 'favorite_id' => 6, 'allergy_id' => 5],
            ['name' => 'Udang Goreng Tepung', 'favorite_id' => 6, 'allergy_id' => 2],
            ['name' => 'Sup Udang', 'favorite_id' => 6, 'allergy_id' => 5],
            ['name' => 'Udang Bakar Madu', 'favorite_id' => 6, 'allergy_id' => 5],
            ['name' => 'Cumi Bakar', 'favorite_id' => 7, 'allergy_id' => null],
            ['name' => 'Tumis Cumi', 'favorite_id' => 7, 'allergy_id' => null],
            ['name' => 'Cumi Goreng Tepung', 'favorite_id' => 7, 'allergy_id' => 2],
            ['name' => 'Sop Cumi', 'favorite_id' => 7, 'allergy_id' => null],
            ['name' => 'Nasi Goreng Cumi', 'favorite_id' => 7, 'allergy_id' => null],
            ['name' => 'Tempe Orek', 'favorite_id' => 8, 'allergy_id' => null],
            ['name' => 'Tumis Tempe', 'favorite_id' => 8, 'allergy_id' => null],
            ['name' => 'Tempe Mendoan', 'favorite_id' => 8, 'allergy_id' => 7],
            ['name' => 'Sambal Goreng Tempe', 'favorite_id' => 8, 'allergy_id' => null],
            ['name' => 'Tempe Balado', 'favorite_id' => 8, 'allergy_id' => null],
            ['name' => 'Oseng Tahu', 'favorite_id' => 9, 'allergy_id' => null],
            ['name' => 'Tahu Goreng', 'favorite_id' => 9, 'allergy_id' => null],
            ['name' => 'Tahu Isi', 'favorite_id' => 9, 'allergy_id' => 7],
            ['name' => 'Mapo Tahu', 'favorite_id' => 9, 'allergy_id' => null],
            ['name' => 'Tahu Kuning Panggang', 'favorite_id' => 9, 'allergy_id' => null],
            ['name' => 'Bubur Ayam', 'favorite_id' => 10, 'allergy_id' => null],
            ['name' => 'Gudeg Jogja', 'favorite_id' => 10, 'allergy_id' => null],
            ['name' => 'Nasi Uduk', 'favorite_id' => 10, 'allergy_id' => 9],
            ['name' => 'Nasi Kuning', 'favorite_id' => 10, 'allergy_id' => null],
            ['name' => 'Nasi Pecel', 'favorite_id' => 10, 'allergy_id' => 1],
            ['name' => 'Kentang Goreng', 'favorite_id' => 11, 'allergy_id' => null],
            ['name' => 'Donat Kentang', 'favorite_id' => 11, 'allergy_id' => 2],
            ['name' => 'Kentang Balado', 'favorite_id' => 11, 'allergy_id' => null],
            ['name' => 'Perkedel Kentang', 'favorite_id' => 11, 'allergy_id' => 4],
            ['name' => 'Sup Kentang', 'favorite_id' => 11, 'allergy_id' => null],
            ['name' => 'Pizza', 'favorite_id' => 12, 'allergy_id' => 2],
            ['name' => 'Sandwich', 'favorite_id' => 12, 'allergy_id' => 2],
            ['name' => 'Martabak Manis', 'favorite_id' => 12, 'allergy_id' => 4],
            ['name' => 'Kue Lapis', 'favorite_id' => 12, 'allergy_id' => 4],
            ['name' => 'Roti Tawar', 'favorite_id' => 12, 'allergy_id' => 2],
            ['name' => 'Spaghetti Bolognese', 'favorite_id' => 13, 'allergy_id' => 2],
            ['name' => 'Lasagna', 'favorite_id' => 13, 'allergy_id' => 2],
            ['name' => 'Fettuccine Alfredo', 'favorite_id' => 13, 'allergy_id' => 2],
            ['name' => 'Macaroni Schotel', 'favorite_id' => 13, 'allergy_id' => 4],
            ['name' => 'Ravioli', 'favorite_id' => 13, 'allergy_id' => 4],
            ['name' => 'Mie Goreng', 'favorite_id' => 14, 'allergy_id' => 2],
            ['name' => 'Bakmi Ayam', 'favorite_id' => 14, 'allergy_id' => 2],
            ['name' => 'Mie Rebus', 'favorite_id' => 14, 'allergy_id' => 2],
            ['name' => 'Yamin', 'favorite_id' => 14, 'allergy_id' => 2],
            ['name' => 'Mie Aceh', 'favorite_id' => 14, 'allergy_id' => null],
            ['name' => 'Telur Dadar', 'favorite_id' => 15, 'allergy_id' => null],
            ['name' => 'Telur Ceplok', 'favorite_id' => 15, 'allergy_id' => null],
            ['name' => 'Telur Rebus', 'favorite_id' => 15, 'allergy_id' => 9],
            ['name' => 'Telur Orak-Arik', 'favorite_id' => 15, 'allergy_id' => 9],
            ['name' => 'Telur Balado', 'favorite_id' => 15, 'allergy_id' => 4],
        ];

        DB::table('menus')->insert($menus);
    }
}
