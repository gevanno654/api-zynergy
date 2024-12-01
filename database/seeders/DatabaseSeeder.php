<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed Interests
        $interests = [
            'Berenang', 'Voli', 'Jogging', 'Yoga', 'Aerobik', 'Senam', 'Bersepeda', 'Hiking', 'Pilates', 'Badminton', 'Sepak Bola', 'Tenis', 'Golf', 'Senam Lantai', 'Zumba'
        ];
        foreach ($interests as $interest) {
            DB::table('interests')->insert([
                'name' => $interest,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Favorites
        $favorites = [
            'Ayam', 'Bebek', 'Ikan', 'Daging Sapi', 'Daging Kambing', 'Udang', 'Cumi', 'Tempe', 'Tahu', 'Telur', 'Kentang', 'Nasi', 'Mie', 'Pasta', 'Roti'
        ];
        foreach ($favorites as $favorite) {
            DB::table('favorites')->insert([
                'name' => $favorite,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Allergies
        $allergies = [
            'Kacang', 'Gluten', 'Laktosa', 'Telur', 'Ikan', 'Kerang', 'Kedelai', 'Gandum', 'Susu', 'Jagung', 'Stroberi', 'Tomat', 'Wijen', 'Bawang Putih', 'Seledri'
        ];
        foreach ($allergies as $allergy) {
            DB::table('allergies')->insert([
                'name' => $allergy,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Diseases
        $diseases = [
            'Maag', 'Obesitas', 'Bipolar', 'Insomnia', 'Nyeri Otot', 'Penyakit Jantung', 'Flu', 'Batuk', 'Radang Usus', 'Anemia', 'Radang Tenggorokan', 'Asma', 'Asam Lambung', 'Sakit Kepala', 'Hipertensi', 'Nyeri Sendi'
        ];
        foreach ($diseases as $disease) {
            DB::table('diseases')->insert([
                'name' => $disease,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
