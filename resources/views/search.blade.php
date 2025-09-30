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
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white" id="headerTitle">
                SIMUNS
            </h1>
            
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
                
                @if ($totalResults > 0)
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($results as $mahasiswa)
                            <div class="p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition duration-200 bg-gray-50">
                                <p class="text-lg font-semibold text-indigo-600">{{ $mahasiswa->nama }}</p>
                                <p class="text-sm text-gray-700">NIM: {{ $mahasiswa->nim }}</p>
                                <p class="text-sm text-gray-500">Program Studi: {{ $mahasiswa->jenjang_prodi }}</p>
                                <p class="text-xs text-gray-400">Status Saat Ini: {{ $mahasiswa->status_saat_ini }} | Tanggal Masuk: {{ date('d M Y', strtotime($mahasiswa->tanggal_masuk)) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                            
                            <div class="flex space-x-2">
                                @if ($results->onFirstPage())
                                    <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                                        &laquo; First
                                    </span>
                                @else
                                    <a href="{{ $results->url(1) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-indigo-600">
                                        &laquo; First
                                    </a>
                                @endif
                                
                                @if ($results->onFirstPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                                        &lt; Previous
                                    </span>
                                @else
                                    <a href="{{ $results->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-indigo-600">
                                        &lt; Previous
                                    </a>
                                @endif
                            </div>

                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
                                <p class="text-sm text-gray-700">
                                    Halaman {{ $results->currentPage() }} dari {{ $results->lastPage() }}
                                </p>
                            </div>

                            <div class="flex space-x-2">
                                @if ($results->hasMorePages())
                                    <a href="{{ $results->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-indigo-600">
                                        Next &gt;
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                                        Next &gt;
                                    </span>
                                @endif
                                
                                @if ($results->hasMorePages())
                                    <a href="{{ $results->url($results->lastPage()) }}" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:text-indigo-600">
                                        Last &raquo;
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
                                        Last &raquo;
                                    </span>
                                @endif
                            </div>
                        </nav>
                    </div>
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

    </body>
</html>