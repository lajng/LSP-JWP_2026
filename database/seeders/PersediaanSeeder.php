<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersediaanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('persediaans')->insert([
            [
                'kode_barang' => 'BRG-001',
                'nama_barang' => 'Monitor Gaming ASUS ROG 24 Inch',
                'stok_masuk' => 25,
                'stok_keluar' => 5,
                'stok_akhir' => 20,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-002',
                'nama_barang' => 'Keyboard Mechanical VortexSeries GT',
                'stok_masuk' => 40,
                'stok_keluar' => 12,
                'stok_akhir' => 28,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-003',
                'nama_barang' => 'Mouse Wireless Logitech G Pro',
                'stok_masuk' => 15,
                'stok_keluar' => 15,
                'stok_akhir' => 0,
                'status' => 'Tidak Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_barang' => 'BRG-004',
                'nama_barang' => 'Kursi Gaming Secretlab Titan',
                'stok_masuk' => 8,
                'stok_keluar' => 1,
                'stok_akhir' => 7,
                'status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
