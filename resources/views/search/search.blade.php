<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUNS - Pencarian: {{ $searchQuery }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body class="bg-gray-50 font-sans antialiased pt-20">
    
    <header id="mainHeader" class="fixed top-0 left-0 w-full z-50 py-4 bg-indigo-700 shadow-xl"> 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-white hover:text-indigo-100 transition duration-300 ease-in-out">
                <h1 class="text-5xl font-extrabold">
                    SIMUNS
                </h1>
            </a>
            
            <div class="flex items-center space-x-2">
                @auth 
                    
                    <span class="text-white text-md font-medium hidden sm:inline-block">
                        Halo, {{ Auth::user()->nama ?? 'Mahasiswa' }}!
                    </span>

                    <a href="{{ route('profile') }}" class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-2 px-4 sm:px-6 rounded-l-full transition-all duration-300 shadow-lg inline-flex items-center text-sm sm:text-base">
                        Profil
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white hover:bg-red-600 font-bold py-2 px-4 sm:px-6 rounded-r-full transition-all duration-300 shadow-lg text-sm sm:text-base">
                            Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-2 px-6 rounded-full transition-all duration-300 shadow-lg inline-flex items-center">
                        Login
                    </a>
                @endguest
            </div>
        </div>
    </header>

    <main class="w-full bg-gray-50 relative z-10 mx-auto py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800 mb-4 inline-block">&larr; Kembali ke Beranda</a>

            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">
                Hasil Pencarian Data Mahasiswa
            </h1>
            <p class="text-xl text-gray-600 mb-8">
                Menampilkan hasil untuk: {{ $searchQuery }} ({{ $totalResults }} ditemukan)
            </p>
            
            <div class="bg-white rounded-xl shadow-xl p-6 md:p-8 border-t-8 border-indigo-700">
                <form class="relative" id="searchForm" action="#" method="GET" onsubmit="return handleSearchSubmit(event)"> 
                    <input 
                        type="search" 
                        placeholder="Kata kunci: [Nama] [NIM] [Prodi]" 
                        class="w-full p-4 pr-12 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-lg"
                        aria-label="Cari mahasiswa"
                        name="search_query"
                        value="{{ $searchQuery ?? '' }}" {{-- Mengisi input dengan query yang sedang dicari --}}
                    >
                    <button 
                        type="submit" 
                        class="absolute right-0 top-0 h-full flex items-center justify-center pr-4 text-indigo-600 hover:text-indigo-300 transition-colors duration-200"
                        aria-label="Tombol Cari"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
                <div class="p-5"></div>
                @if ($totalResults > 0)
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($results as $mahasiswa)
                            <a href="{{ route('mahasiswa.info', ['hash_id' => $mahasiswa->hash_id]) }}" 
                            class="block p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition duration-200 bg-gray-50 hover:bg-indigo-50 cursor-pointer"
                            >
                                <p class="text-lg font-semibold text-indigo-600 hover:text-indigo-800">{{ $mahasiswa->nama }}</p>
                                <p class="text-sm text-gray-700">NIM: {{ $mahasiswa->nim }}</p>
                                <p class="text-sm text-gray-500">Program Studi: {{ $mahasiswa->jenjang_prodi }}</p>
                                <p class="text-xs text-gray-400">Status Saat Ini: {{ $mahasiswa->status_saat_ini }} | Tanggal Masuk: {{ date('d M Y', strtotime($mahasiswa->tanggal_masuk)) }}</p>
                            </a>
                        @endforeach
                    </div>

                    {{-- BAGIAN PAGINATION DITAMBAHKAN DI SINI --}}
                    @if ($results->lastPage() > 1)
                    <div class="mt-10 flex justify-center items-center space-x-3 text-sm font-semibold">
                        
                        {{-- First Page Link --}}
                        <a href="{{ $results->url(1) }}" 
                           class="px-4 py-2 rounded-full transition duration-300 shadow-md 
                           @if ($results->currentPage() == 1) 
                               bg-gray-200 text-gray-500 cursor-not-allowed opacity-50 
                           @else 
                               bg-indigo-600 text-white hover:bg-indigo-700 
                           @endif">
                            &laquo;
                        </a>

                        {{-- Previous Page Link --}}
                        <a href="{{ $results->previousPageUrl() }}" 
                           class="px-4 py-2 rounded-full transition duration-300 border 
                           @if ($results->onFirstPage()) 
                               bg-gray-100 text-gray-400 cursor-not-allowed opacity-50 
                           @else 
                               bg-white text-indigo-600 border-indigo-600 hover:bg-indigo-50 
                           @endif">
                            &lsaquo;
                        </a>

                        {{-- Current Page Status --}}
                        <span class="px-5 py-2 bg-indigo-100 text-indigo-800 rounded-full font-bold">
                            Halaman {{ $results->currentPage() }} dari {{ $results->lastPage() }}
                        </span>

                        {{-- Next Page Link --}}
                        <a href="{{ $results->nextPageUrl() }}" 
                           class="px-4 py-2 rounded-full transition duration-300 border 
                           @if (!$results->hasMorePages()) 
                               bg-gray-100 text-gray-400 cursor-not-allowed opacity-50 
                           @else 
                               bg-white text-indigo-600 border-indigo-600 hover:bg-indigo-50 
                           @endif">
                            &rsaquo;
                        </a>

                        {{-- Last Page Link --}}
                        <a href="{{ $results->url($results->lastPage()) }}" 
                           class="px-4 py-2 rounded-full transition duration-300 shadow-md 
                           @if ($results->currentPage() == $results->lastPage()) 
                               bg-gray-200 text-gray-500 cursor-not-allowed opacity-50 
                           @else 
                               bg-indigo-600 text-white hover:bg-indigo-700 
                           @endif">
                             &raquo;
                        </a>
                    </div>
                    @endif
                    
                @else
                    <p class="text-gray-500 italic">Maaf, tidak ditemukan data mahasiswa yang cocok dengan kata kunci "{{ $searchQuery }}".</p>
                @endif
            </div>
            
        </div>
    </main>

    <footer class="relative z-10 bg-white py-6 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500">
            &copy; Copyright &copy; 2025 SIMUNS.
        </div>
    </footer>

    <script>
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
    </script>
    </body>
</html>
