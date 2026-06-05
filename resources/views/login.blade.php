<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warehouse Management System</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100 font-sans antialiased flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">

        <!-- HEADER: Brand Aplikasi -->
        <div class="bg-slate-900 p-8 text-white text-center relative overflow-hidden">
            <!-- Variasi Background Efek Glow -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-indigo-600 rounded-full blur-2xl opacity-40"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-emerald-600 rounded-full blur-2xl opacity-20"></div>

            <div class="relative z-10 flex flex-col items-center">
                <!-- Icon Box / Gudang -->
                <div class="bg-indigo-600 p-3 rounded-xl shadow-lg mb-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-black tracking-wider text-white">Gudang HP Yteam</h1>
                <p class="text-[10px] text-indigo-300 mt-1 uppercase tracking-widest font-semibold">Gudang HP terbaik</p>
            </div>
        </div>

        <!-- BODY: Form Login -->
        <div class="p-8 space-y-6">
            <div class="text-center">
                <h2 class="text-xl font-bold text-slate-800">Selamat Datang, Jon!</h2>
                <p class="text-sm text-slate-500 mt-1">Masukkan akun untuk mengelola stok & inventory.</p>
            </div>

            <!-- Notifikasi Error Login -->
            @error('username')
                <div
                    class="bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded-r-lg text-xs flex items-start space-x-2 animate-pulse">
                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror

            <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Email (name="username" biar singkron ke controller lu) -->
                <div>
                    <label for="username"
                        class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Email
                        Gudang</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                        <input type="email" id="username" name="username" value="{{ old('username') }}" required
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition duration-200"
                            placeholder="admin@gudang.com">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label for="password"
                            class="block text-xs font-bold uppercase tracking-wider text-slate-600">Password</label>
                    </div>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-indigo-600 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition duration-200"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500/30 border-slate-300 rounded-md cursor-pointer transition duration-200">
                        <label for="remember" class="ml-2 block text-sm text-slate-600 select-none cursor-pointer">
                            Ingat perangkat ini
                        </label>
                    </div>
                </div>

                <!-- Button Submit -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-500/30 active:bg-indigo-800 transition duration-200">
                        Masuk Ke Dasbor Gudang
                    </button>
                </div>
            </form>
        </div>

        <!-- FOOTER -->
        <div class="bg-slate-50 px-8 py-4 border-t border-slate-100 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} StockFlow. All rights reserved.
        </div>
    </div>

</body>

</html>
