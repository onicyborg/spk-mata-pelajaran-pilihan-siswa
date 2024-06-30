<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Guru',
                'username' => '1122334455',
                'password' => Hash::make('1122334455'),
                'role' => 'Guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siswa',
                'username' => '6677889900',
                'password' => Hash::make('6677889900'),
                'role' => 'Siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('mata_pelajaran')->insert([
            [
                'nama_mapel' => 'Matematika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mapel' => 'IPA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mapel' => 'IPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mapel' => 'Bahasa Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mapel' => 'Bahasa Inggris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mapel' => 'Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mapel' => 'Pancasila',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mapel' => 'Agama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mapel' => 'PJOK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
