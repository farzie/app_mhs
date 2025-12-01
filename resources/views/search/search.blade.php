<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUNS - Pencarian: {{ $searchQuery }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #eef2f8; /* Latar belakang abu-abu kebiruan yang sangat terang */
        }
        
        /* Style untuk kontainer utama yang membungkus kotak pencarian dan hasil (diperbarui) */
        .search-results-container {
            /* Shadow yang lebih dalam untuk blok hasil */
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.1), 0 3px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #c7d2fe; /* Border indigo muda */
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem; /* rounded-xl */
            background-color: white; /* Pastikan background putih untuk konten utama */
            width: 100%; 
        }

        /* Style untuk setiap item hasil pencarian */
        .result-item {
            padding: 1.5rem 0; /* Padding vertikal yang cukup */
            display: flex; 
            align-items: center;
            transition: background-color 0.2s; /* Transisi untuk feedback klik */
        }
        .result-item:not(:last-child) {
            border-bottom: 1px solid #e5e7eb; /* Garis pemisah horizontal */
        }
        .result-item:hover {
            background-color: #f9fafb; /* Sedikit perubahan warna saat hover untuk indikasi interaktif */
        }

        /* Styling untuk Pagination */
        .pagination-link {
            /* Menambahkan rounded corners, background (default light gray), dan hover visual feedback */
            @apply px-4 py-2 text-sm font-semibold transition duration-300 rounded-lg bg-gray-100 hover:bg-indigo-50 text-indigo-700 hover:text-indigo-800;
        }

        .pagination-status {
            /* Status lebih menonjol dengan background dan rounded */
            @apply px-4 py-2 text-sm font-extrabold shadow-sm bg-pink-50 text-pink-700 rounded-lg;
        }
        
        .font-brand {
            font-family: 'Poppins', sans-serif;
        }

    </style>
    
</head>
<body class="bg-gray-100 font-brand antialiased min-h-screen pt-[5.5rem] md:pt-[5rem]">
    
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

    {{-- Class main-content dihapus dari main --}}
    <main class="w-full mx-auto">
        
        

        {{-- Search Results Container (Sekarang memiliki class max-w-7xl) --}}
        <div class="search-results-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Breadcrumb / Back Link --}}
            <a href="{{ url('/') }}" class="border-2 border-indigo-200 bg-indigo-50/50 ml-8 p-1 mt-12 bg-indigo-600 rounded-xl max-w-7xl text-white hover:text-indigo-100 font-semibold mb-2 inline-flex items-center transition duration-200 text-base">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Halaman Utama
            </a>

            {{-- Bagian Header Pencarian --}}
            <div class="p-6 md:p-8 pb-4">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-2">
                    Hasil Pencarian Data Mahasiswa
                </h1>
                <p class="text-base md:text-lg text-gray-600 mb-6">
                    Ditemukan <span class="font-extrabold text-pink-600">{{ $totalResults }}</span> hasil yang cocok untuk kata kunci: 
                    <span class="font-extrabold text-indigo-800 italic">"{{ $searchQuery }}"</span>
                </p>
                
                {{-- Search Form --}}
                <form class="relative" id="searchForm" action="#" method="GET" onsubmit="return handleSearchSubmit(event)"> 
                    <input 
                        type="search" 
                        placeholder="Cari lagi: [Nama] [NIM] [Prodi]..." 
                        class="w-full p-4 pr-16 border-2 border-indigo-200 bg-indigo-50/50 rounded-xl shadow-inner focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/30 text-lg font-medium transition duration-200"
                        aria-label="Cari mahasiswa"
                        name="search_query"
                        value="{{ $searchQuery ?? '' }}" 
                    >
                    <button 
                        type="submit" 
                        class="absolute right-0 top-0 h-full flex items-center justify-center pr-5 text-indigo-600 hover:text-pink-600 transition-colors duration-200"
                        aria-label="Tombol Cari"
                    >
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>
            {{-- End of Header Pencarian --}}

            {{-- Search Results Display (Single Column List) --}}
            <div class="min-h-[300px] px-6 md:px-8 pt-4">
                @if ($totalResults > 0)
                    
                    <div class="divide-y divide-gray-200">
                        @foreach ($results as $mahasiswa)
                            <a href="{{ route('mahasiswa.info', ['hash_id' => $mahasiswa->hash_id]) }}" 
                            class="result-item flex items-center justify-between"
                            >
                                
                                {{-- Main Info (Name & NIM) --}}
                                <div class="flex-1 min-w-0 pr-4 sm:pr-8">
                                    <p class="text-lg sm:text-xl font-extrabold text-indigo-800 leading-snug hover:text-pink-600 transition duration-200 truncate">
                                        {{ $mahasiswa->nama }}
                                    </p>
                                    <p class="text-xs sm:text-sm font-medium text-gray-600 mt-1">
                                        NIM: <span class="font-extrabold text-gray-900">{{ $mahasiswa->nim }}</span>
                                    </p>
                                </div>

                                {{-- Secondary Info (Prodi & Status) - Responsive display --}}
                                <div class="flex flex-col sm:flex-row items-end sm:items-center space-y-2 sm:space-y-0 sm:space-x-6 text-xs sm:text-sm text-right">
                                    
                                    {{-- Program Studi --}}
                                    <div class="flex items-center text-gray-700">
                                        <svg class="w-4 h-4 mr-1 text-indigo-500 flex-shrink-0 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="font-semibold truncate max-w-[120px] sm:max-w-[150px]">{{ $mahasiswa->jenjang_prodi }}</span>
                                    </div>
                                    
                                    {{-- Status --}}
                                    <div class="flex items-center text-gray-500">
                                        <svg class="w-4 h-4 mr-1 text-green-500 flex-shrink-0 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.618a1 1 0 010 1.414l-9 9a1 1 0 01-.439.291c-.027.01-.06.014-.087.027a1 1 0 01-1.076-.298l-5-5a1 1 0 011.414-1.414l4.354 4.354 8.293-8.293a1 1 0 011.414 0z"></path></svg>
                                        Status: <span class="ml-1 font-bold text-green-600">{{ $mahasiswa->status_saat_ini }}</span>
                                    </div>
                                </div>

                                {{-- Arrow Icon --}}
                                <div class="text-indigo-500 hover:text-pink-600 transition duration-200 ml-4 hidden sm:block">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- BAGIAN PAGINATION (Tiga Tingkat Responsif) --}}
                    @if ($results->lastPage() > 1)
                    <div class="pt-6 pb-6 mt-0 flex flex-col space-y-3 sm:flex-row sm:justify-center sm:items-center sm:space-y-0 sm:space-x-6 text-sm bg-gray-50 rounded-b-lg -mx-6 md:-mx-8 px-6 md:px-8 border-t border-gray-200">
                        
                        <div class="flex justify-center space-x-3 order-1">
                            {{-- First Page Link --}}
                            <a href="{{ $results->url(1) }}" 
                               class="pagination-link 
                               @if ($results->currentPage() == 1) 
                                    text-gray-400 cursor-not-allowed opacity-70 bg-gray-200 hover:bg-gray-200 hover:text-gray-400
                               @else 
                                    text-indigo-600 
                               @endif">
                                &laquo; Awal
                            </a>

                            {{-- Previous Page Link --}}
                            <a href="{{ $results->previousPageUrl() }}" 
                               class="pagination-link 
                               @if ($results->onFirstPage()) 
                                    text-gray-400 cursor-not-allowed opacity-50 bg-gray-200 hover:bg-gray-200 hover:text-gray-400
                               @else 
                                    text-indigo-600 
                               @endif">
                                &lsaquo; Sebelumnya
                            </a>
                        </div>

                        <div class="flex justify-center order-2">
                            {{-- Current Page Status (Lebih menonjol dengan background dan rounded) --}}
                            <span class="pagination-status">
                                Halaman {{ $results->currentPage() }} / {{ $results->lastPage() }}
                            </span>
                        </div>

                        <div class="flex justify-center space-x-3 order-3">
                            {{-- Next Page Link --}}
                            <a href="{{ $results->nextPageUrl() }}" 
                               class="pagination-link 
                               @if (!$results->hasMorePages()) 
                                    text-gray-400 cursor-not-allowed opacity-50 bg-gray-200 hover:bg-gray-200 hover:text-gray-400
                               @else 
                                    text-indigo-600 
                               @endif">
                                Berikutnya &rsaquo;
                            </a>

                            {{-- Last Page Link --}}
                            <a href="{{ $results->url($results->lastPage()) }}" 
                               class="pagination-link 
                               @if ($results->currentPage() == $results->lastPage()) 
                                    text-gray-400 cursor-not-allowed opacity-70 bg-gray-200 hover:bg-gray-200 hover:text-gray-400
                               @else 
                                    text-indigo-600 
                               @endif">
                                Akhir &raquo;
                            </a>
                        </div>
                    </div>
                    @endif
                    
                @else
                    <div class="text-center p-12">
                        <svg class="w-16 h-16 mx-auto text-pink-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                        <h2 class="text-2xl font-bold text-gray-700 mt-4">Tidak Ada Data Ditemukan</h2>
                        <p class="text-lg text-gray-500 mt-2">Pencarian untuk "{{ $searchQuery }}" tidak menghasilkan kecocokan.</p>
                        <p class="text-sm text-gray-400 mt-4">Silakan coba kata kunci yang berbeda atau cek kembali ejaan yang digunakan.</p>
                    </div>
                @endif
            </div>
            
        </div>
        
    </main>

    <footer class="relative z-10 bg-gray-900 py-8 border-t border-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            <p class="text-lg font-bold text-white mb-2">SIMUNS</p>
            <p>&copy; Copyright 2025. Sistem Informasi Mahasiswa Universitas Sebelas Maret.</p>
        </div>
    </footer>
    <script>
        // Fungsi JavaScript untuk menghandle submit form pencarian
        function handleSearchSubmit(event) {
            event.preventDefault();
            
            const inputElement = document.querySelector('input[name="search_query"]');
            let searchQuery = inputElement.value.trim();

            if (searchQuery) {
                const encodedQuery = encodeURIComponent(searchQuery);

                // Mengarahkan ke route pencarian dengan query yang baru
                // Asumsi base path adalah /search/
                window.location.href = `{{ url('/search') }}/${encodedQuery}`; 
            }
            return false;
        }
    </script>
</body>
</html>