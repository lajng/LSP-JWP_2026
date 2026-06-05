@extends('layouts.app')

@section('title', 'Daftar Barang - StockFlow')
@section('page_title', 'Master Daftar Barang')

@section('content')
    <div class="space-y-8 animate-fade-in" x-data="{ modalTambah: false, modalEdit: false, modalDetail: false, currentId: '', currentKode: '', currentNama: '', currentKategoriId: '', currentKategoriNama: '', detailTanggal: '' }">

        @if (session('success'))
            <div
                class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl text-sm font-bold shadow-sm">
                🎉 {{ session('success') }}
            </div>
        @endif

        <div
            class="bg-white/70 backdrop-blur-xl p-6 rounded-3xl border border-indigo-100 shadow-xl shadow-indigo-500/5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
            <div class="flex items-center space-x-4">
                <div
                    class="p-3.5 bg-gradient-to-br from-purple-500 to-blue-500 rounded-2xl text-white shadow-lg shadow-indigo-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Katalog Produk Utama</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Kelola identitas semua jenis komoditas yang
                        tersedia di dalam ekosistem gudang pusat.</p>
                </div>
            </div>
            <button @click="modalTambah = true"
                class="bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 text-white text-xs font-black uppercase tracking-wider px-6 py-3.5 rounded-2xl transition-all duration-200 shadow-lg shadow-indigo-500/20 active:scale-95">
                + Tambah Barang
            </button>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 bg-white p-2">
            <div class="overflow-x-auto rounded-2xl">
                <table class="w-full text-left text-sm border-separate border-spacing-y-2 px-2">
                    <thead>
                        <tr class="text-slate-400 uppercase text-[10px] font-black tracking-widest">
                            <th class="px-6 py-3">ID Kode</th>
                            <th class="px-6 py-3">Nama Produk</th>
                            <th class="px-6 py-3">Klasifikasi Kategori</th>
                            <th class="px-6 py-3 text-center w-48">Aksi Penanganan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-0">
                        @forelse($barang as $item)
                            <tr
                                class="group bg-slate-50/40 hover:bg-gradient-to-r hover:from-purple-50/50 hover:to-blue-50/50 border border-transparent hover:border-indigo-100 transition-all duration-200 rounded-2xl shadow-sm">
                                <td
                                    class="px-6 py-4 rounded-l-2xl font-mono font-black text-xs text-indigo-600 bg-white group-hover:bg-transparent transition-all">
                                    <span
                                        class="bg-indigo-50 px-2.5 py-1.5 rounded-lg border border-indigo-100/50">{{ $item->kode_barang }}</span>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $item->nama_barang }}</td>
                                <td class="px-6 py-4 font-medium text-slate-500">
                                    <span
                                        class="bg-slate-100 text-slate-600 text-[11px] font-bold px-2.5 py-1 rounded-md">{{ $item->kategori->nama_kategori }}</span>
                                </td>
                                <td class="px-6 py-4 rounded-r-2xl text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button
                                            @click="modalDetail = true; currentKode = '{{ $item->kode_barang }}'; currentNama = '{{ $item->nama_barang }}'; currentKategoriNama = '{{ $item->kategori->nama_kategori }}'; detailTanggal = '{{ $item->created_at->format('d M Y H:i') }}'"
                                            class="bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white p-2 rounded-xl transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button
                                            @click="modalEdit = true; currentId = '{{ $item->id }}'; currentKode = '{{ $item->kode_barang }}'; currentNama = '{{ $item->nama_barang }}'; currentKategoriId = '{{ $item->kategori_id }}'"
                                            class="bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white p-2 rounded-xl transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <form action="{{ route('master.barang.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus barang ini, jon?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-rose-50 hover:bg-rose-500 text-rose-600 hover:text-white p-2 rounded-xl transition shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="rounded-2xl bg-slate-50/30 border border-dashed border-slate-200">
                                    <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                                        <h4 class="text-sm font-black text-slate-700 tracking-tight">Katalog Produk Kosong
                                        </h4>
                                        <p class="text-xs text-slate-400 font-medium max-w-xs mt-1">Belum ada komoditas
                                            terdaftar. Gunakan tombol di atas untuk menambah barang perdana jon.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="modalTambah"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100"
                @click.outside="modalTambah = false">
                <h3 class="text-xl font-black text-slate-800 mb-6">Registrasi Produk Baru</h3>
                <form action="{{ route('master.barang.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Kode
                            Barang</label>
                        <input type="text" name="kode_barang" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Nama
                            Barang</label>
                        <input type="text" name="nama_barang" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Kategori
                            Klasifikasi</label>
                        <select name="kategori_id" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button" @click="modalTambah = false"
                            class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition">Batal</button>
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-purple-600 to-blue-500 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition shadow-lg shadow-indigo-500/20">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="modalEdit"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100"
                @click.outside="modalEdit = false">
                <h3 class="text-xl font-black text-slate-800 mb-6">Ubah Atribut Produk</h3>
                <form :action="'/master/barang/' + currentId" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Kode
                            Barang</label>
                        <input type="text" name="kode_barang" :value="currentKode" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Nama
                            Barang</label>
                        <input type="text" name="nama_barang" :value="currentNama" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Kategori
                            Klasifikasi</label>
                        <select name="kategori_id"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}"
                                    :selected="currentKategoriId == '{{ $kat->id }}'">{{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button" @click="modalEdit = false"
                            class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition">Batal</button>
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition shadow-lg shadow-amber-500/20">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="modalDetail"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100"
                @click.outside="modalDetail = false">
                <h3 class="text-xl font-black text-slate-800 mb-6">Spesifikasi Katalog</h3>
                <div class="space-y-4">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">ID
                            Identitas</span>
                        <span
                            class="text-sm font-black text-indigo-600 mt-1 block font-mono bg-white inline-block px-2 py-1 rounded-lg border border-indigo-100"
                            x-text="currentKode"></span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Nama
                            Deskripsi</span>
                        <span class="text-sm font-black text-slate-800 mt-1 block" x-text="currentNama"></span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Grup
                            Klasifikasi</span>
                        <span class="text-xs font-bold text-slate-600 bg-slate-200 px-2 py-1 rounded-md mt-1 inline-block"
                            x-text="currentKategoriNama"></span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Waktu
                            Registrasi</span>
                        <span class="text-sm font-bold text-slate-700 mt-1 block" x-text="detailTanggal"></span>
                    </div>
                    <div class="pt-4">
                        <button type="button" @click="modalDetail = false"
                            class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition shadow-md">Tutup
                            Detail</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
