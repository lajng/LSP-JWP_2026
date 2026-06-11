@extends('layouts.app')

@section('title', 'Manajemen Pengguna - Gundang HP')
@section('page_title', 'Manajemen Pengguna')

@section('content')
    <div class="space-y-8 animate-fade-in" x-data="{ modalTambah: false, modalEdit: false, modalDetail: false, currentId: '', currentNama: '', currentEmail: '', currentRole: '', detailTanggal: '' }">

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
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-800 tracking-tight">Otoritas Akses Sistem</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Kelola kredensial, hak akses, dan tingkat keamanan
                        akun operator gudang.</p>
                </div>
            </div>
            @if (Auth::user()->role === 'admin')
                <button @click="modalTambah = true"
                    class="bg-gradient-to-r from-purple-600 to-blue-500 hover:from-purple-700 hover:to-blue-600 text-white text-xs font-black uppercase tracking-wider px-6 py-3.5 rounded-2xl transition-all duration-200 shadow-lg shadow-indigo-500/20 active:scale-95">
                    + Tambah Pengguna
                </button>
            @endif
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 bg-white p-2">
            <div class="overflow-x-auto rounded-2xl">
                <table class="w-full text-left text-sm border-separate border-spacing-y-2 px-2">
                    <thead>
                        <tr class="text-slate-400 uppercase text-[10px] font-black tracking-widest">
                            <th class="px-6 py-3 w-16">Inisial</th>
                            <th class="px-6 py-3">Nama Lengkap</th>
                            <th class="px-6 py-3">Alamat Email</th>
                            <th class="px-6 py-3">Hak Akses</th>
                            <th class="px-6 py-3 text-center w-48">Aksi Penanganan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-0">
                        @forelse($users as $item)
                            <tr
                                class="group bg-slate-50/40 hover:bg-gradient-to-r hover:from-purple-50/50 hover:to-blue-50/50 border border-transparent hover:border-indigo-100 transition-all duration-200 rounded-2xl shadow-sm">
                                <td class="px-6 py-4 rounded-l-2xl bg-white group-hover:bg-transparent transition-all">
                                    <div
                                        class="w-8 h-8 rounded-xl bg-gradient-to-tr from-purple-500 to-indigo-500 text-white flex items-center justify-center text-xs font-black uppercase shadow-sm shadow-indigo-500/10">
                                        {{ substr($item->name, 0, 2) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $item->name }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-500 font-mono text-xs">{{ $item->email }}
                                </td>
                                <td class="px-6 py-4 font-medium">
                                    @if ($item->role == 'admin')
                                        <span
                                            class="bg-purple-50 text-purple-600 border border-purple-100 text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm">Admin</span>
                                    @else
                                        <span
                                            class="bg-blue-50 text-blue-600 border border-blue-100 text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-md shadow-sm">Petugas</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 rounded-r-2xl text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button
                                            @click="modalDetail = true; currentNama = '{{ $item->name }}'; currentEmail = '{{ $item->email }}'; currentRole = '{{ $item->role }}'; detailTanggal = '{{ $item->created_at->format('d M Y H:i') }}'"
                                            class="bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white p-2 rounded-xl transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button
                                            @click="modalEdit = true; currentId = '{{ $item->id }}'; currentNama = '{{ $item->name }}'; currentEmail = '{{ $item->email }}'; currentRole = '{{ $item->role }}'"
                                            class="bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white p-2 rounded-xl transition shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        @if (Auth::user()->role === 'admin' && Auth::id() != $item->id)
                                            <form action="{{ route('master.user.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus akun ini, jon?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-rose-50 hover:bg-rose-500 text-rose-600 hover:text-white p-2 rounded-xl transition shadow-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="rounded-2xl bg-slate-50/30 border border-dashed border-slate-200">
                                    <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                                        <h4 class="text-sm font-black text-slate-700 tracking-tight">Data Pengguna Kosong
                                        </h4>
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
                <h3 class="text-xl font-black text-slate-800 mb-6">Registrasi Akun Baru</h3>
                <form action="{{ route('master.user.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Nama
                            Lengkap</label>
                        <input type="text" name="name" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Email</label>
                        <input type="email" name="email" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Password
                            Akun</label>
                        <input type="password" name="password" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Hak Akses
                            Sistem</label>
                        <select name="role" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas Gudang</option>
                        </select>
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button" @click="modalTambah = false"
                            class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition">Batal</button>
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-purple-600 to-blue-500 text-white font-bold text-xs uppercase tracking-wider py-3.5 rounded-2xl transition shadow-lg shadow-indigo-500/20">Daftarkan</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="modalEdit"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
            style="display: none;">
            <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100"
                @click.outside="modalEdit = false">
                <h3 class="text-xl font-black text-slate-800 mb-1">Ubah Kredensial Akun</h3>
                <p class="text-xs text-slate-400 mb-6 font-medium">Kosongkan kolom password jika tidak ingin mengganti
                    password lama.</p>
                <form :action="'/master/users/' + currentId" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Nama
                            Lengkap</label>
                        <input type="text" name="name" :value="currentNama" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Email</label>
                        <input type="email" name="email" :value="currentEmail" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Password Baru
                            (Opsional)</label>
                        <input type="password" name="password"
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                    </div>
                    @if (Auth::user()->role === 'admin')
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-400 tracking-wider mb-2">Hak Akses
                                Sistem</label>
                            <select name="role"
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-indigo-500 transition">
                                <option value="admin" :selected="currentRole == 'admin'">Admin</option>
                                <option value="petugas" :selected="currentRole == 'petugas'">Petugas Gudang</option>
                            </select>
                        </div>
                    @endif
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
                <h3 class="text-xl font-black text-slate-800 mb-6">Informasi Akun</h3>
                <div class="space-y-4">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Nama
                            Anggota</span>
                        <span class="text-sm font-black text-slate-800 mt-1 block" x-text="currentNama"></span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Korespondensi
                            Email</span>
                        <span class="text-xs font-bold text-indigo-600 font-mono mt-1 block" x-text="currentEmail"></span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Tingkat Hak
                            Akses</span>
                        <span
                            class="text-xs font-black uppercase tracking-wider bg-slate-200 text-slate-700 px-2.5 py-1 rounded-md mt-1 inline-block"
                            x-text="currentRole"></span>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="block text-[10px] font-black uppercase text-slate-400 tracking-wider">Waktu
                            Bergabung</span>
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
