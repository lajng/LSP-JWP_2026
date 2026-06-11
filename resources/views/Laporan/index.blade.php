@extends('layouts.app')

@section('title', 'Laporan Logistik - Gundang HP')
@section('page_title', 'Laporan Persediaan Gudang')

@section('content')
    <div class="space-y-6">

        {{-- CONTROLLER AREA: Form Filter & Dropdown Ekspor Dokumen --}}
        <div
            class="bg-white/70 backdrop-blur-xl p-6 rounded-3xl border border-indigo-100 shadow-xl shadow-indigo-500/5 flex flex-col md:flex-row md:items-end justify-between gap-6 print:hidden">

            {{-- Form Penanganan Filter (Kategori & Rentang Tanggal) --}}
            <form action="{{ route('laporan.index') }}" method="GET"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 flex-1 items-end w-full">
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-wider mb-1.5">
                        Klasifikasi Kategori
                    </label>
                    <select name="kategori_id"
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-2.5 text-xs font-bold focus:outline-none focus:border-indigo-500 transition">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-wider mb-1.5">
                        Tanggal Mulai
                    </label>
                    <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-2.5 text-xs font-bold focus:outline-none focus:border-indigo-500 transition">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-wider mb-1.5">
                        Tanggal Selesai
                    </label>
                    <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-2.5 text-xs font-bold focus:outline-none focus:border-indigo-500 transition">
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                        class="flex-1 bg-slate-900 hover:bg-slate-800 text-white text-xs font-black uppercase tracking-wider py-3.5 rounded-2xl transition shadow-sm">
                        Filter
                    </button>
                    @if (request('kategori_id') || request('tanggal_mulai') || request('tanggal_selesai'))
                        <a href="{{ route('laporan.index') }}"
                            class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-black uppercase tracking-wider px-4 rounded-2xl transition flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Komponen Dropdown Navigasi Aksi Ekspor Laporan --}}
            <div class="relative inline-block text-left w-full md:w-auto shrink-0" id="dropdownContainer">
                <div>
                    <button type="button" onclick="toggleDropdown()"
                        class="w-full md:w-auto bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 text-white text-xs font-black uppercase tracking-wider px-6 py-3.5 rounded-2xl transition-all duration-200 shadow-lg shadow-indigo-500/20 active:scale-95 flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l3-3m-3 3l-3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span>Ekspor Laporan</span>
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>

                {{-- Blok Menu Pilihan Dropdown (Warna Teks & Icon Sudah Static) --}}
                <div id="dropdownMenu"
                    class="hidden absolute right-0 mt-2 w-56 rounded-2xl shadow-xl bg-white ring-1 ring-black ring-opacity-5 divide-y divide-slate-100 z-50 origin-top-right transform transition-all duration-200">
                    <div class="py-1">

                        {{-- Opsi 1: Cetak PDF (Warna Merah Adobe) --}}
                        <button type="button" onclick="window.print(); toggleDropdown();"
                            class="w-full text-left flex items-center px-4 py-3 text-xs font-black text-rose-600 hover:bg-rose-50 transition">
                            <svg class="w-4 h-4 mr-2.5 text-rose-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                </path>
                            </svg>
                            Cetak Dokumen (PDF)
                        </button>

                        {{-- Opsi 2: Unduh Excel (Warna Hijau Microsoft) --}}
                        <button type="button" onclick="unduhExcel()"
                            class="w-full text-left flex items-center px-4 py-3 text-xs font-black text-emerald-600 hover:bg-emerald-50 transition">
                            <svg class="w-4 h-4 mr-2.5 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Unduh Format Excel
                        </button>

                    </div>
                </div>
            </div>
        </div>

        {{-- Kop Surat Cetak (Hanya tampil saat mode cetak kertas/PDF aktif) --}}
        <div class="hidden print:block mb-8 text-center border-b-2 border-slate-900 pb-4">
            <h1 class="text-3xl font-black tracking-widest text-slate-950">Gundang HP LOGISTICS</h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">
                Laporan Rekapitulasi Mutasi Persediaan Barang Real-Time
            </p>
            @if (request('tanggal_mulai') && request('tanggal_selesai'))
                <p class="text-xs font-bold text-indigo-600 mt-1">Periode:
                    {{ date('d M Y', strtotime(request('tanggal_mulai'))) }} s/d
                    {{ date('d M Y', strtotime(request('tanggal_selesai'))) }}
                </p>
            @endif
            <p class="text-[11px] text-slate-400 mt-2">Tanggal Cetak: {{ date('d M Y H:i:s') }}</p>
        </div>

        {{--  DATA TABLE AREA: Menampilkan Baris Record Mutasi Barang --}}
        <div
            class="overflow-hidden rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 bg-white p-2 print:border-none print:shadow-none print:p-0">
            <div class="overflow-x-auto rounded-2xl">
                <table id="tabelLaporan"
                    class="w-full text-left text-sm border-separate border-spacing-y-2 px-2 print:border-collapse print:border-spacing-0 print:px-0">
                    <thead>
                        <tr
                            class="text-slate-400 uppercase text-[10px] font-black tracking-widest print:text-slate-700 print:border-b print:border-slate-300">
                            <th class="px-6 py-3 print:px-2 print:py-2">Kode</th>
                            <th class="px-6 py-3 print:px-2 print:py-2">Deskripsi Nama Barang</th>
                            <th class="px-6 py-3 print:px-2 print:py-2">Kategori</th>
                            <th class="px-6 py-3 text-center print:px-2 print:py-2">Stok Masuk</th>
                            <th class="px-6 py-3 text-center print:px-2 print:py-2">Stok Keluar</th>
                            <th class="px-6 py-3 text-center print:px-2 print:py-2">Stok Akhir</th>
                            <th class="px-6 py-3 text-center print:px-2 print:py-2 print:hidden">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-0 print:divide-y print:divide-slate-200">
                        @forelse($laporan as $item)
                            <tr
                                class="group bg-slate-50/40 border border-transparent rounded-2xl shadow-sm print:bg-transparent print:shadow-none print:rounded-none">
                                <td
                                    class="px-6 py-4 rounded-l-2xl font-mono font-black text-xs text-indigo-600 bg-white group-hover:bg-transparent print:bg-transparent print:px-2 print:py-3 print:text-slate-900">
                                    {{ $item->kode_barang }}
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800 print:px-2 print:py-3 print:font-medium">
                                    {{ $item->nama_barang }}
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-500 print:px-2 print:py-3">
                                    <span
                                        class="bg-slate-100 text-slate-600 text-[11px] font-bold px-2.5 py-1 rounded-md print:bg-transparent print:p-0 print:text-slate-900">
                                        {{ $item->nama_kategori }}
                                    </span>
                                </td>
                                <td
                                    class="px-6 py-4 text-center text-emerald-600 font-extrabold print:px-2 print:py-3 print:text-slate-900 print:font-normal">
                                    {{ $item->stok_masuk }}
                                </td>
                                <td
                                    class="px-6 py-4 text-center text-rose-600 font-extrabold print:px-2 print:py-3 print:text-slate-900 print:font-normal">
                                    {{ $item->stok_keluar }}
                                </td>
                                <td class="px-6 py-4 text-center print:px-2 print:py-3">
                                    <span
                                        class="inline-block bg-slate-900 text-white font-black text-xs px-3 py-1.5 rounded-xl shadow-inner print:bg-transparent print:text-slate-950 print:p-0 print:font-bold print:text-sm">
                                        {{ $item->stok_akhir }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 rounded-r-2xl text-center print:hidden">
                                    {{-- FIX: Mengubah @graves menjadi @else standar Blade Engine --}}
                                    @if ($item->stok_akhir > 0)
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-200">Ready</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-rose-50 text-rose-500 border border-rose-200">Empty</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    class="rounded-2xl bg-slate-50/30 border border-dashed border-slate-200 py-8 text-center text-slate-400 italic">
                                    Tidak ditemukan rekaman mutasi logistik untuk filter terpilih jon.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 
         JAVASCRIPT LOGIC AREA: Manajemen DOM Dropdown & Ekspor Excel
          --}}
    <script>
        // Mengatur status visibilitas komponen menu pilihan dropdown
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.classList.toggle('hidden');
        }

        // Listener Global: Menutup otomatis menu dropdown jika pengguna mengklik area luar tombol
        window.addEventListener('click', function(e) {
            const container = document.getElementById('dropdownContainer');
            const menu = document.getElementById('dropdownMenu');
            if (container && !container.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        // MANIPULASI CLIENT-SIDE: Konversi Objek Tabel HTML ke Blob File Microsoft Excel Spreadsheet
        function unduhExcel() {
            const tabel = document.getElementById("tabelLaporan");
            const htmlTabel = tabel.outerHTML;

            // Gabungkan string HTML dengan skema format Data URI bertipe MS-Excel
            const dataUri = 'data:application/vnd.ms-excel;charset=utf-8,' + encodeURIComponent(htmlTabel);

            // Bangun elemen jangkar samaran (anchor tag) untuk memicu download otomatis
            const linkDownload = document.createElement("a");
            linkDownload.href = dataUri;
            linkDownload.download = "Laporan_Persediaan_Gudang.xls";

            linkDownload.click();
            toggleDropdown();
        }
    </script>
@endsection