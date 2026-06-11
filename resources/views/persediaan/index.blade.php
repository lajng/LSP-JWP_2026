@extends('layouts.app')

@section('title', 'Persediaan Barang - Gundang HP')
@section('page_title', 'Persediaan Barang')

@section('content')
    <div class="space-y-8 animate-fade-in" x-data="{ modalMasuk: false, modalKeluar: false }">

        @if (session('success'))
            <div
                class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-bold shadow-sm">
                🎉 {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-700 px-6 py-4 rounded-2xl text-sm font-bold shadow-sm">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <div
            class="bg-white/70 backdrop-blur-xl p-6 rounded-3xl border border-indigo-100 shadow-xl shadow-indigo-500/5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="flex items-center space-x-4">
                <div
                    class="p-3.5 bg-gradient-to-br from-purple-500 to-blue-500 rounded-2xl text-white shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Kondisi Stok Real-Time</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Alur mutasi logistik otomatis gudang pusat.</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button @click="modalMasuk = true"
                    class="flex-1 lg:flex-none bg-gradient-to-r from-emerald-400 via-emerald-500 to-teal-500 hover:from-emerald-500 hover:to-teal-600 text-white text-xs font-black uppercase tracking-wider px-5 py-3.5 rounded-2xl transition-all duration-200 shadow-lg shadow-emerald-500/20 active:scale-95">
                    + Barang Masuk
                </button>
                <button @click="modalKeluar = true"
                    class="flex-1 lg:flex-none bg-gradient-to-r from-rose-400 via-rose-500 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white text-xs font-black uppercase tracking-wider px-5 py-3.5 rounded-2xl transition-all duration-200 shadow-lg shadow-rose-500/20 active:scale-95">
                    - Barang Keluar
                </button>
            </div>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 bg-white p-2">
            <div class="overflow-x-auto rounded-2xl">
                <table class="w-full text-left text-sm border-separate border-spacing-y-2 px-2">
                    <thead>
                        <tr class="text-slate-400 uppercase text-[10px] font-black tracking-widest">
                            <th class="px-6 py-3">ID Kode</th>
                            <th class="px-6 py-3">Deskripsi Barang</th>
                            <th class="px-6 py-3 text-center">Stok Masuk</th>
                            <th class="px-6 py-3 text-center">Stok Keluar</th>
                            <th class="px-6 py-3 text-center">Stok Akhir</th>
                            <th class="px-6 py-3 text-center">Status Distribusi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-0">
                        @forelse($persediaan as $item)
                            <tr
                                class="group bg-slate-50/40 hover:bg-gradient-to-r hover:from-purple-50/50 hover:to-blue-50/50 border border-transparent hover:border-indigo-100 transition-all duration-200 rounded-2xl shadow-sm">
                                <td
                                    class="px-6 py-4 rounded-l-2xl font-mono font-black text-xs text-indigo-600 bg-white group-hover:bg-transparent transition-all">
                                    <span
                                        class="bg-indigo-50 px-2.5 py-1.5 rounded-lg border border-indigo-100/50">{{ $item->kode_barang }}</span>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $item->nama_barang }}</td>
                                <td class="px-6 py-4 text-center text-emerald-600 font-extrabold text-base">
                                    {{ $item->stok_masuk }}</td>
                                <td class="px-6 py-4 text-center text-rose-600 font-extrabold text-base">
                                    {{ $item->stok_keluar }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-block bg-slate-900 text-white font-black text-xs px-3 py-1.5 rounded-xl shadow-inner">{{ $item->stok_akhir }}</span>
                                </td>
                                <td class="px-6 py-4 rounded-r-2xl text-center">
                                    @if ($item->status == 'Tersedia' && $item->stok_akhir > 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-200 shadow-sm shadow-emerald-500/5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-ping"></span>
                                            Ready
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-rose-50 text-rose-500 border border-rose-200 shadow-sm shadow-rose-500/5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-400 mr-2"></span>
                                            Empty
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="rounded-2xl bg-slate-50/30 border border-dashed border-slate-200">
                                    <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-tr from-purple-100 to-blue-100 rounded-2xl flex items-center justify-center text-indigo-500 mb-4 shadow-inner">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-2M4 13H6m0 0v4a2 2 0 002 2h8a2 2 0 002-2v-4M6 13h12">
                                                </path>
                                            </svg>
                                        </div>
                                        <h4 class="text-sm font-black text-slate-700 tracking-tight">Belum Ada Barang di
                                            Master Data</h4>
                                        <p class="text-xs text-slate-400 font-medium max-w-xs mt-1">Silakan isi menu Daftar
                                            Barang terlebih dahulu agar data otomatis tersinkronisasi di sini jon.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="modalMasuk"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100"
                @click.outside="modalMasuk = false">
                <h3 class="text-xl font-black text-slate-800 mb-1">Log Barang Masuk</h3>
                <p class="text-xs text-slate-400 mb-6 font-medium">Pilih produk terdaftar untuk menambahkan pasokan stok
                    baru.</p>

                <form action="{{ route('persediaan.masuk') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Pilih
                            Barang</label>
                        <select name="barang_id" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                            @foreach ($masterBarang as $b)
                                <option value="{{ $b->id }}">{{ $b->kode_barang }} - {{ $b->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Jumlah
                            Masuk</label>
                        <input type="number" name="jumlah" min="1" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button" @click="modalMasuk = false"
                            class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition">Batal</button>
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition shadow-lg shadow-emerald-500/20">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="modalKeluar"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100"
                @click.outside="modalKeluar = false">
                <h3 class="text-xl font-black text-slate-800 mb-1">Log Barang Keluar</h3>
                <p class="text-xs text-slate-400 mb-6 font-medium">Pilih produk terdaftar untuk mencatat pengeluaran
                    logistik.</p>

                <form action="{{ route('persediaan.keluar') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Pilih
                            Barang</label>
                        <select name="barang_id" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                            @foreach ($masterBarang as $b)
                                <option value="{{ $b->id }}">{{ $b->kode_barang }} - {{ $b->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Jumlah
                            Keluar</label>
                        <input type="number" name="jumlah" min="1" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button" @click="modalKeluar = false"
                            class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition">Batal</button>
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-rose-500 to-pink-500 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition shadow-lg shadow-rose-500/20">Kurangi</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
