<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StockFlow Dashboard')</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-50 font-sans antialiased text-slate-800">

    <div class="min-h-screen flex flex-col p-4 md:p-6 gap-6">

        <nav
            class="w-full max-w-7xl mx-auto bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-500 rounded-3xl shadow-xl shadow-indigo-500/20 px-6 py-4 flex items-center justify-between text-white relative z-50">

            <div class="flex items-center space-x-3">
                <div class="bg-white/20 backdrop-blur-md p-2 rounded-2xl border border-white/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <span class="text-xl font-black tracking-widest">GUDANG HP Yteam</span>
            </div>

            <div class="hidden md:flex items-center space-x-2" x-data="{ openMaster: false }">

                <a href="{{ url('/dashboard') }}"
                    class="px-4 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 {{ Request::is('dashboard') ? 'bg-white text-indigo-600 shadow-md' : 'hover:bg-white/10' }}">
                    Dashboard
                </a>

                <a href="{{ route('persediaan.index') }}"
                    class="px-4 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 {{ Request::is('persediaan*') ? 'bg-white text-indigo-600 shadow-md' : 'hover:bg-white/10' }}">
                    Persediaan Barang
                </a>

                <div class="relative">
                    <button @click="openMaster = !openMaster" @click.outside="openMaster = false"
                        class="px-4 py-2.5 rounded-xl font-bold text-sm flex items-center space-x-1 transition-all duration-200 {{ Request::is('master*') ? 'bg-white/20 border border-white/30' : 'hover:bg-white/10' }}">
                        <span>Master Data</span>
                        <svg class="w-4 h-4 transform transition-transform duration-200"
                            :class="openMaster ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="openMaster" x-transition
                        class="absolute left-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 p-2 space-y-1 text-slate-700"
                        style="display: none;">
                        <a href="{{ route('master.kategori.index') }}"
                            class="block py-2.5 px-4 text-xs font-bold rounded-xl transition hover:bg-indigo-50 hover:text-indigo-600 {{ Request::is('master/kategori*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                            Menu Kategori Barang
                        </a>
                        <a href="{{ route('master.barang.index') }}"
                            class="block py-2.5 px-4 text-xs font-bold rounded-xl transition hover:bg-indigo-50 hover:text-indigo-600 {{ Request::is('master/barang*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                            Menu Daftar Barang
                        </a>

                        <a href="{{ route('master.user.index') }}"
                            class="block py-2.5 px-4 text-xs font-bold rounded-xl transition hover:bg-indigo-50 hover:text-indigo-600 {{ Request::is('master/users*') ? 'bg-indigo-50 text-indigo-600' : '' }}">
                            Menu Manajemen Pengguna
                        </a>

                    </div>
                </div>
                <a href="{{ route('laporan.index') }}"
                    class="px-4 py-2.5 rounded-xl font-bold text-sm transition-all duration-200 {{ Request::is('laporan*') ? 'bg-white text-indigo-600 shadow-md' : 'hover:bg-white/10' }}">
                    Laporan
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <div
                    class="hidden sm:flex items-center space-x-3 bg-white/10 px-4 py-1.5 rounded-2xl border border-white/10">
                    <div
                        class="w-8 h-8 rounded-xl bg-white text-indigo-600 flex items-center justify-center font-black uppercase text-xs">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-bold truncate max-w-[100px]">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-white/70 font-medium capitalize">{{ Auth::user()->role }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-white/10 hover:bg-red-500 hover:text-white p-2.5 rounded-2xl transition duration-200 border border-white/10 group">
                        <svg class="w-5 h-5 text-white group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>

        </nav>

        <main class="w-full max-w-7xl mx-auto flex-1">
            <div class="flex items-center justify-between mb-6 px-2">
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">@yield('page_title', 'Sistem Gudang')</h2>
                <span
                    class="text-xs font-bold text-indigo-600 bg-indigo-50 border border-indigo-100 px-4 py-2 rounded-xl shadow-sm">
                    📅 {{ date('d M Y') }}
                </span>
            </div>

            @yield('content')
        </main>

    </div>

</body>

</html>
