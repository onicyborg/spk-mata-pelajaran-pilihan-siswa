# SPK Mata Pelajaran Pilihan Siswa

## Instalasi Project

Ikuti langkah-langkah di bawah ini untuk menginstal project "SPK Mata Pelajaran Pilihan Siswa" di mesin lokal Anda.

### Langkah-langkah

1. **Buka Terminal:**
   - Arahkan terminal ke direktori di mana Anda ingin menyimpan project ini.

2. **Clone Repository:**
   - Jalankan perintah berikut untuk meng-clone repository project dari GitHub:
     ```sh
     git clone https://github.com/onicyborg/spk-mata-pelajaran-pilihan-siswa.git
     ```

3. **Masuk ke Direktori Project:**
   - Pindah ke direktori project yang baru saja di-clone:
     ```sh
     cd spk-mata-pelajaran-pilihan-siswa
     ```

4. **Buka Project di VSCode:**
   - Buka project di Visual Studio Code dengan perintah:
     ```sh
     code .
     ```

5. **Konfigurasi File Environment:**
   - Buat file `.env` dengan menyalin seluruh isi file `.env.example` ke dalam file `.env` yang baru dibuat:
     ```sh
     cp .env.example .env
     ```
   - Edit file `.env` dan sesuaikan bagian konfigurasi database dengan settingan database lokal Anda. Beri nama database yang akan digunakan.

6. **Install Dependencies:**
   - Jalankan perintah berikut untuk menginstall dependencies yang diperlukan:
     ```sh
     composer install
     ```
   - Jika terdapat error, jalankan perintah berikut untuk mengupdate dependencies:
     ```sh
     composer update
     ```

7. **Migrasi Database:**
   - Jalankan migrasi database untuk membuat tabel-tabel yang diperlukan:
     ```sh
     php artisan migrate
     ```

8. **Seed Database:**
   - Seed database dengan data awal yang diperlukan:
     ```sh
     php artisan db:seed --class=DataSeeder
     ```

9. **Generate Application Key:**
   - Generate application key yang unik untuk project ini:
     ```sh
     php artisan key:generate
     ```

10. **Buat Symbolic Link untuk Storage:**
    - Jalankan perintah berikut untuk membuat symbolic link dari `public/storage` ke `storage/app/public`:
      ```sh
      php artisan storage:link
      ```

11. **Jalankan Server:**
    - Jalankan server aplikasi Laravel dengan perintah:
      ```sh
      php artisan serve
      ```

### Catatan
- Pastikan Anda sudah menginstall Composer dan memiliki environment PHP yang sesuai dengan persyaratan Laravel.
- Jika ada langkah yang terlewat atau membutuhkan bantuan lebih lanjut, Anda dapat merujuk ke dokumentasi resmi Laravel di [https://laravel.com/docs](https://laravel.com/docs).

Dengan mengikuti langkah-langkah di atas, Anda seharusnya bisa menjalankan project "SPK Mata Pelajaran Pilihan Siswa" di mesin lokal Anda. Selamat mencoba!
