<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalStokMasuk = Persediaan::sum('stok_masuk');
        $totalStokKeluar = Persediaan::sum('stok_keluar');
        $stokTertinggi = Persediaan::max('stok_akhir') ?? 0;

        $allBarangWithStok = Barang::leftJoin('persediaans', 'barangs.id', '=', 'persediaans.barang_id')
            ->select(
                'barangs.kode_barang',
                'barangs.nama_barang',
                DB::raw('IFNULL(persediaans.stok_akhir, 0) as stok_akhir')
            )->get();

        $barangKritis = $allBarangWithStok->where('stok_akhir', '<', 10)->sortBy('stok_akhir');
        $stokKritisCount = $barangKritis->count();

        return view('dashboard', compact(
            'totalBarang',
            'totalStokMasuk',
            'totalStokKeluar',
            'stokTertinggi',
            'barangKritis',
            'stokKritisCount'
        ));
    }
}