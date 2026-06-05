@extends('layouts.app')

@section('title', 'Dashboard - Gudang HP Rafah')
@section('page_title', 'Dashboard Utama')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 flex items-center space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Barang</p>
                <h3 class="text-xl font-black text-slate-800 mt-1">{{ number_format($totalBarang) }} <span
                        class="text-xs font-medium text-slate-400">item</span></h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 flex items-center space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 11V4.5M11 4.5L7.5 8M11 4.5l3.5 3.5M4.5 16.5H17.5M17.5 16.5a2 2 0 012 2v1a2 2 0 01-2 2H4.5a2 2 0 01-2-2v-1a2 2 0 012-2z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Stok Masuk</p>
                <h3 class="text-xl font-black text-emerald-600 mt-1">+ {{ number_format($totalStokMasuk) }} <span
                        class="text-xs font-medium text-slate-400">pcs</span></h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 flex items-center space-x-4">
            <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 13v6.5m0 0l3.5-3.5m-3.5 3.5L9.5 16M4.5 7.5H17.5M17.5 7.5a2 2 0 012 2v1a2 2 0 01-2 2H4.5a2 2 0 01-2-2V9.5a2 2 0 012-2z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Stok Keluar</p>
                <h3 class="text-xl font-black text-orange-600 mt-1">- {{ number_format($totalStokKeluar) }} <span
                        class="text-xs font-medium text-slate-400">pcs</span></h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-rose-200 bg-rose-50/30 flex items-center space-x-4">
            <div class="p-3 bg-rose-100 text-rose-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-rose-500">Stok Kritis (&lt;10)</p>
                <h3 class="text-xl font-black text-rose-700 mt-1">{{ $stokKritisCount }} <span
                        class="text-xs font-medium text-rose-400">Produk</span></h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200 flex items-center space-x-4">
            <div class="p-3 bg-violet-50 text-violet-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Stok Tertinggi</p>
                <h3 class="text-xl font-black text-slate-800 mt-1">{{ number_format($stokTertinggi) }} <span
                        class="text-xs font-medium text-slate-400">pcs</span></h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h4 class="text-base font-bold text-slate-800 mb-4">Alert System: Monitor Stok Kritis</h4>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Kode Barang</th>
                        <th class="px-4 py-3">Nama Barang</th>
                        <th class="px-4 py-3">Sisa Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($barangKritis as $item)
                    <tr>
                        <td class="px-4 py-3 font-mono font-bold text-slate-900">{{ $item->kode_barang }}</td>
                        <td class="px-4 py-3">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-3 font-bold text-rose-600">{{ $item->stok_akhir }} pcs</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-slate-400 italic font-medium">
                            🎉 Semua pasokan aman, tidak ada barang berkondisi kritis jon!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection