<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersediaanController extends Controller
{
    public function index()
    {
        $masterBarang = Barang::all();

        $persediaan = Barang::leftJoin('persediaans', 'barangs.id', '=', 'persediaans.barang_id')
            ->select(
                'barangs.id as barang_id',
                'barangs.kode_barang',
                'barangs.nama_barang',
                DB::raw('IFNULL(persediaans.stok_masuk, 0) as stok_masuk'),
                DB::raw('IFNULL(persediaans.stok_keluar, 0) as stok_keluar'),
                DB::raw('IFNULL(persediaans.stok_akhir, 0) as stok_akhir'),
                DB::raw('IFNULL(persediaans.status, "Tidak Tersedia") as status')
            )->get();

        return view('persediaan.index', compact('persediaan', 'masterBarang'));
    }

    public function storeMasuk(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'jumlah' => 'required|numeric|min:1'
        ]);

        $barang = Persediaan::where('barang_id', $request->barang_id)->first();

        if ($barang) {
            $barang->stok_masuk += $request->jumlah;
            $barang->stok_akhir = $barang->stok_masuk - $barang->stok_keluar;
            $barang->status = $barang->stok_akhir > 0 ? 'Tersedia' : 'Tidak Tersedia';
            $barang->save();
        } else {
            Persediaan::create([
                'barang_id' => $request->barang_id,
                'stok_masuk' => $request->jumlah,
                'stok_keluar' => 0,
                'stok_akhir' => $request->jumlah,
                'status' => $request->jumlah > 0 ? 'Tersedia' : 'Tidak Tersedia'
            ]);
        }

        return redirect()->back()->with('success', 'Stok barang masuk berhasil diperbarui');
    }

    public function storeKeluar(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'jumlah' => 'required|numeric|min:1'
        ]);

        $barang = Persediaan::where('barang_id', $request->barang_id)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang belum memiliki riwayat stok masuk');
        }

        $stokAkhirBaru = $barang->stok_akhir - $request->jumlah;

        if ($stokAkhirBaru < 0) {
            return redirect()->back()->with('error', 'Gagal! Jumlah pengeluaran melebihi sisa stok saat ini');
        }

        $barang->stok_keluar += $request->jumlah;
        $barang->stok_akhir = $stokAkhirBaru;
        $barang->status = $stokAkhirBaru > 0 ? 'Tersedia' : 'Tidak Tersedia';
        $barang->save();

        return redirect()->back()->with('success', 'Stok barang keluar berhasil diperbarui');
    }
}
