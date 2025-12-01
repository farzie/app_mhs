<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUNS | Sistem Informasi Mahasiswa UNS</title>
    <meta name="msapplication-TileColor" content="#4c51bf">
    <meta name="theme-color" content="#ffffff">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .font-brand {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-brand antialiased min-h-screen">

    <header id="mainHeader" class="fixed top-0 left-0 w-full z-50 py-3 bg-indigo-900 shadow-xl shadow-indigo-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            
            <a href="{{ route('home') }}" class="text-white hover:text-indigo-200 transition duration-300 ease-in-out flex items-center">
                <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                <h1 class="text-3xl font-extrabold tracking-tight">
                    SIMUNS
                </h1>
            </a>
            
            <div class="flex items-center space-x-2">
                @auth 
                    <span class="text-white text-sm font-medium hidden md:inline-block bg-indigo-700/50 px-4 py-2 rounded-full border border-indigo-500/50">
                        Halo, {{ Auth::user()->nama ?? 'Mahasiswa' }}!
                    </span>

                    <a href="{{ route('profile') }}" class="bg-pink-500 text-white font-semibold py-2 px-4 rounded-full transition-colors duration-300 shadow-lg text-sm hidden sm:inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profil
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-indigo-700 hover:bg-red-100 font-bold py-2 px-4 rounded-full transition-colors duration-300 shadow-md text-sm">
                            Keluar
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="bg-white text-indigo-700 hover:bg-indigo-50 font-extrabold py-2 px-6 rounded-full transition-colors duration-300 shadow-xl inline-flex items-center tracking-wide">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Masuk
                    </a>
                @endguest
            </div>
        </div>
    </header>

    {{-- JUMBOTRON SECTION (TETAP) --}}
    <section class="relative w-full h-[60vh] md:h-[70vh] flex items-center overflow-hidden bg-gradient-to-br from-indigo-900 to-purple-800 text-white">
        {{-- Konten Jumbotron --}}
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-700/80 to-purple-600/80"></div>
        <svg class="absolute bottom-0 left-0 w-full h-auto opacity-10" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,197.3C672,192,768,160,864,165.3C960,171,1056,213,1152,218.7C1248,224,1344,192,1392,176L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-left pt-16 pb-16">
            <h2 class="text-5xl md:text-7xl font-extrabold mb-4 tracking-tighter leading-snug">SIMUNS</h2>
            <h3 class="text-2xl md:text-4xl font-semibold mb-6 opacity-95">Sistem Informasi Mahasiswa UNS</h3>
            <p class="text-lg md:text-xl max-w-xl mb-10 opacity-90">Akses semua informasi, statistik, dan data akademik Mahasiswa UNS dengan mudah dari mana saja.</p>
        </div>
    </section>

    <main class="w-full bg-white relative z-20 mx-auto -mt-16 pt-8 pb-12 lg:-mt-24 lg:pt-16 lg:pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Bagian ini langsung menjadi bagian dari main content, tanpa wrapper card putih besar --}}
            <section id="stats-section" class="mb-12">
                
                {{-- 1. Bagian Pencarian (Diberi Card Styling Individual) --}}
                <div class="mb-12">
                    <h3 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-6 flex items-center">
                        <svg class="w-7 h-7 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Pencarian Mahasiswa
                    </h3>
                    
                    <form class="relative group" id="searchForm" action="#" method="GET" onsubmit="return handleSearchSubmit(event)"> 
                        <input 
                            type="search" 
                            placeholder="Cari berdasarkan: Nama, NIM, atau Program Studi..." 
                            class="w-full p-4 pr-16 border border-gray-200 bg-gray-50 rounded-xl shadow-inner transition-shadow focus:outline-none focus:ring-4 focus:ring-indigo-500/50 text-base md:text-lg font-medium"
                            aria-label="Cari mahasiswa"
                            name="search_query"
                        >
                        <button 
                            type="submit" 
                            class="absolute right-0 top-0 h-full flex items-center justify-center pr-4 text-indigo-500 hover:text-pink-500 transition-colors duration-200"
                            aria-label="Tombol Cari"
                        >
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>

                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-6 pt-4 border-b border-gray-300 pb-3">
                    Statistik Data Mahasiswa UNS
                </h3>

                {{-- 2. Bagian Statistik Utama (Card Grid) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    
                    @php
                        $total_mahasiswa = $total_mahasiswa ?? 26;
                        $mahasiswa_aktif = $mahasiswa_aktif ?? 15;
                        $mahasiswa_lulus = $mahasiswa_lulus ?? 3;
                    @endphp

                    {{-- Statistik Card 1: Total Mahasiswa --}}
                    <div class="bg-white p-6 rounded-xl border-2 shadow-md">
                        {{-- Simbol Berwarna --}}
                        <svg class="w-8 h-8 mb-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20h-2m2 0h2m-2 0h-2m0 0a5 5 0 01-5-5V9a5 5 0 0110 0v11z"></path>
                        </svg>
                        
                        <p class="text-sm font-medium uppercase text-gray-500 ">Total Mahasiswa Terdaftar</p>
                        <p class="text-5xl font-extrabold mt-1 tracking-tight text-gray-900">{{ number_format($total_mahasiswa) }}</p>
                        
                        <p class="text-xs text-gray-400 mt-3 flex items-center">Data kumulatif semua angkatan.</p>
                    </div>
                    
                    {{-- Statistik Card 2: Mahasiswa Aktif --}}
                    <div class="*bg-white p-6 rounded-xl border-2 shadow-md">
                        <svg class="w-8 h-8 mb-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.24l-7.782 7.782-2.5-2.5M10 20a10 10 0 100-20 10 10 0 000 20z"></path>
                        </svg>

                        <p class="text-sm font-medium uppercase text-gray-500">Mahasiswa Aktif Saat Ini</p>
                        <p class="text-5xl font-extrabold mt-1 tracking-tight text-gray-900">{{ number_format($mahasiswa_aktif) }}</p>
                        
                        <p class="text-xs text-gray-400 mt-3 flex items-center">Status: Aktif dan Terdaftar.</p>
                    </div>
                    
                    {{-- Statistik Card 3: Lulusan / Alumni --}}
                    <div class="bg-white p-6 rounded-xl border-2 shadow-md">
                        <svg class="w-8 h-8 mb-3 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>

                        <p class="text-sm font-medium uppercase text-gray-500">Lulusan / Alumni</p>
                        <p class="text-5xl font-extrabold mt-1 tracking-tight text-gray-900">{{ number_format($mahasiswa_lulus) }}</p>
                        
                        <p class="text-xs text-gray-400 mt-3 flex items-center">Kontribusi UNS di Dunia Kerja.</p>
                    </div>
                </div>

                {{-- 3. Bagian Detail Status Akademik (Card Grid) --}}
                <h3 class="text-2xl font-bold text-gray-800 mb-6 pt-4 border-t border-gray-200 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.947 9.947 0 0112 3c5.522 0 10 3.758 10 8.411 0 1.259-.29 2.476-.838 3.593M11 3.055h5M11 3.055L6.345 7.71m0 0a1.99 1.99 0 01-2.828 0L3 6.345m0 0V4m0 0h2.345M6.345 7.71L3 4"></path></svg>
                    Detail Status Akademik
                </h3>
                
                @php
                    // Data simulasi status_distribusi
                    $status_distribusi = $status_distribusi ?? [
                        'Aktif' => 15,
                        'Cuti' => 4,
                        'Mengundurkan Diri' => 3,
                        'Lulus' => 3,
                        'Hilang' => 1,
                    ];
                    $statusIcons = [
                        'Aktif' => ['color' => 'text-blue-600', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253'],
                        'Cuti' => ['color' => 'text-yellow-600', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'Mengundurkan Diri' => ['color' => 'text-red-600', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        'Lulus' => ['color' => 'text-green-600', 'icon' => 'M9 12l2 2 4-4m5.618-4.24L12 17.25m-1.25-1.25L5.382 7.76'],
                        'Hilang' => ['color' => 'text-gray-600', 'icon' => 'M9.172 16.172A4 4 0 0112 20h0v-2m0 0v-2m0-8V6a4 4 0 014-4h0M5 5v2m0 0h2m-2 0l2 2m-2-2L9.172 9.172'],
                    ];
                @endphp

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 text-center">
                    
                    @foreach ($statusIcons as $status => $details)
                        @php $count = $status_distribusi[$status] ?? 0; @endphp
                        {{-- Setiap item adalah card kecil di dalam grid --}}
                        <div class="p-4 rounded-xl bg-white border-2 shadow-md">
                            <svg class="w-8 h-8 mx-auto mb-2 {{ $details['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $details['icon'] }}"></path></svg>
                            <p class="text-3xl font-extrabold {{ $details['color'] }}">{{ number_format($count) }}</p>
                            <p class="text-sm font-semibold mt-1 text-gray-700">{{ $status }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </main>
    <footer class="relative z-10 bg-gray-900 py-8 border-t border-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            <p class="text-lg font-bold text-white mb-2">SIMUNS</p>
            <p>&copy; Copyright 2025. Sistem Informasi Mahasiswa Universitas Sebelas Maret.</p>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function handleSearchSubmit(event) {
                event.preventDefault(); 
                
                const inputElement = document.querySelector('input[name="search_query"]');
                let searchQuery = inputElement.value.trim();

                if (searchQuery) {
                    const encodedQuery = encodeURIComponent(searchQuery);
                    window.location.href = `/search/${encodedQuery}`;
                }
                
                return false;
            }

            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', handleSearchSubmit);
            }
        });
    </script>
</body>
</html>