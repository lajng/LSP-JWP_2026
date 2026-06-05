<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Barang;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        $apple = Kategori::create(['nama_kategori' => 'Apple']);
        $samsung = Kategori::create(['nama_kategori' => 'Samsung']);
        $xiaomi = Kategori::create(['nama_kategori' => 'Xiaomi']);
        $aksesoris = Kategori::create(['nama_kategori' => 'Aksesoris']);

        Barang::create([
            'kode_barang' => 'HP-APL15PM',
            'nama_barang' => 'iPhone 15 Pro Max 256GB',
            'kategori_id' => $apple->id
        ]);

        Barang::create([
            'kode_barang' => 'HP-APL13',
            'nama_barang' => 'iPhone 13 128GB Black',
            'kategori_id' => $apple->id
        ]);

        Barang::create([
            'kode_barang' => 'HP-SAM24U',
            'nama_barang' => 'Samsung Galaxy S24 Ultra',
            'kategori_id' => $samsung->id
        ]);

        Barang::create([
            'kode_barang' => 'HP-SAMA55',
            'nama_barang' => 'Samsung Galaxy A55 5G',
            'kategori_id' => $samsung->id
        ]);

        Barang::create([
            'kode_barang' => 'HP-XIA14',
            'nama_barang' => 'Xiaomi 14 Ultra',
            'kategori_id' => $xiaomi->id
        ]);

        Barang::create([
            'kode_barang' => 'HP-RED13P',
            'nama_barang' => 'Redmi Note 13 Pro+ 5G',
            'kategori_id' => $xiaomi->id
        ]);

        Barang::create([
            'kode_barang' => 'AKS-GAN65',
            'nama_barang' => 'Anker Charger GaN 65W',
            'kategori_id' => $aksesoris->id
        ]);

        Barang::create([
            'kode_barang' => 'AKS-CBLTYC',
            'nama_barang' => 'Kabel Data Type-C to Type-C 1M',
            'kategori_id' => $aksesoris->id
        ]);
    }
}
