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

        // Data dengan ID 0 (Tidak Ada)
        DB::table('allergies')->insert([
            'id' => 0, // ID 0 untuk "Tidak Ada"
            'name' => 'Tidak Ada',
            'created_at' => null,
            'updated_at' => null,
        ]);

        // Data lainnya
        $allergies = [
            'Kacang', 'Gluten', 'Laktosa', 'Telur', 'Ikan', 'Kerang', 'Kedelai', 'Gandum', 'Susu', 'Jagung', 'Stroberi', 'Tomat', 'Wijen', 'Bawang Putih', 'Seledri'
        ];

        foreach ($allergies as $allergy) {
            DB::table('allergies')->insert([
                'name' => $allergy,
                'created_at' => null,
                'updated_at' => null,
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

            // Seed Users
        DB::table('users')->insert([
            [
                    'name' => 'Admin Health Care',
                    'gender' => 'male',
                    'email' => 'admin@healthcare.com',
                    'password' => bcrypt('password'),
                    'verification_codes' => null,
                    'verification_codes_created_at' => null,
                    'email_verified_at' => now(),
                    'remember_token' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
            ],
            [
                    'name' => 'User Example',
                    'gender' => 'female',
                    'email' => 'user@example.com',
                    'password' => bcrypt('password'),
                    'verification_codes' => '123456',
                    'verification_codes_created_at' => now(),
                    'email_verified_at' => null,
                    'remember_token' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
            ]
        ]);
    }
}
