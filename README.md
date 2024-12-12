# Health Care App

Selamat datang di repositori *Zynergy*. Proyek ini adalah aplikasi berbasis Laravel yang bertujuan untuk membantu pengguna mengelola kesehatan mereka melalui fitur-fitur seperti pengingat makan, tidur, aktivitas ringan, dan pemeriksaan kesehatan rutin, serta memberikan rekomendasi makanan dan artikel kesehatan sesuai dengan kondisi pengguna.

## Fitur Utama

1. *Pengingat Kesehatan*:
   - Pengingat waktu makan dengan menu sehat.
   - Pengingat kualitas tidur dengan notifikasi waktu tidur dan alarm bangun.
   - Pengingat aktivitas ringan seperti peregangan, berdiri, dan berjalan.
   - Pengingat untuk pemeriksaan kesehatan rutin.

2. *Rekomendasi Personalisasi*:
   - Sugesti makanan berdasarkan alergi, penyakit, dan minat pengguna.
   - Artikel kesehatan yang relevan dengan kondisi dan minat pengguna.

3. *Manajemen Data Pengguna*:
   - Pilihan minat, penyakit, dan alergi.
   - Verifikasi email saat registrasi.


## Teknologi yang Digunakan

- *Framework*: Laravel 10
- *Database*: MySQL
- *Front-End*: Blade Templates
- *Deployment API*: ArenHost
- *Tools Pengembangan*: Laragon, Composer

## Instalasi

### Persyaratan Minimum
- PHP >= 8.1
- Composer
- MySQL

### Langkah Instalasi

1. Clone repositori ini:
   bash
   git clone https://github.com/username/repo-health-care.git
   cd repo-health-care
   

2. Install dependensi Laravel:
   bash
   composer install
   

3. Salin file .env.example menjadi .env:
   bash
   cp .env.example .env
   

4. Konfigurasi file .env sesuai dengan environment Anda (database, mail, dll).

5. Generate application key:
   bash
   php artisan key:generate
   

6. Migrasi dan seed database:
   bash
   php artisan migrate --seed
   

7. Jalankan server pengembangan:
   bash
   php artisan serve
   

## Penggunaan

1. *API*
   - Endpoint utama dapat diakses melalui api.php. Contoh endpoint login: /api/login
   - Dokumentasi API akan segera ditambahkan.

2. *Aplikasi Mobile*
   - API siap untuk diintegrasikan dengan aplikasi mobile menggunakan framework seperti Flutter atau React Native.

## Struktur Database

- *Tables*:
  - users: Data pengguna.
  - interests: Daftar minat yang tersedia.
  - diseases: Daftar penyakit yang tersedia.
  - allergies: Daftar alergi yang tersedia.
  - reminders: Data pengingat yang dibuat pengguna.

## Kontribusi

Kontribusi sangat dihargai! Untuk kontribusi:

1. Fork repositori ini.
2. Buat branch baru untuk fitur/bugfix:
   bash
   git checkout -b fitur-baru
   
3. Commit perubahan Anda:
   bash
   git commit -m "Menambahkan fitur baru"
   
4. Push branch Anda:
   bash
   git push origin fitur-baru
   
5. Ajukan pull request.

## Lisensi

Proyek ini dilisensikan di bawah [Zynergy].

---

Jika ada pertanyaan atau masalah, silakan buat issue di GitHub atau hubungi kami melalui email di *zynergy.app@gmail.com*.
