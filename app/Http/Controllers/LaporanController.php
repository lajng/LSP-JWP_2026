<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        
        $query = Barang::leftJoin('persediaans', 'barangs.id', '=', 'persediaans.barang_id')
            ->leftJoin('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->select(
                'barangs.kode_barang',
                'barangs.nama_barang',
                'kategoris.nama_kategori',
                DB::raw('IFNULL(persediaans.stok_masuk, 0) as stok_masuk'),
                DB::raw('IFNULL(persediaans.stok_keluar, 0) as stok_keluar'),
                DB::raw('IFNULL(persediaans.stok_akhir, 0) as stok_akhir'),
                DB::raw('IFNULL(persediaans.status, "Tidak Tersedia") as status')
            );

        if ($request->filled('kategori_id')) {
            $query->where('barangs.kategori_id', $request->kategori_id);
        }

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween(DB::raw('DATE(persediaans.updated_at)'), [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        $laporan = $query->get();

        return view('laporan.index', compact('laporan', 'kategori'));
    }
}