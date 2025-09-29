<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <header id="mainHeader" class="fixed top-0 left-0 w-full z-50 py-4"> 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-5xl font-extrabold text-white" id="headerTitle">
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

    <section class="w-full z-0 fixed bg-gradient-to-l from-indigo-900 to-indigo-700 text-white flex items-top justify-left pl-0 md:pl-20 h-full">
        <div class="max-w-xs md:max-w-3xl text-left z-10 p-4 pt-20 md:pt-40">
            <h2 class="text-2xl md:text-3xl font-extrabold mb-4">
                Sistem Informasi Mahasiswa UNS
            </h2>
            <p class="text-xl md:text-2xl font-bold mb-8 opacity-90">
                Akses informasi Data Mahasiswa UNS di mana saja
            </p>
            <button class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-4 px-8 rounded-full transition-all duration-300">
                Pelajari Selengkapnya >
            </button>
        </div>
    </section>

    <div class="h-0 md:h-20"></div>
    <div class="h-80"></div>

    <main class="w-full bg-gray-50 relative z-10 mx-auto pt-8 pb-12 lg:pt-12 lg:pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <section class="mb-12 bg-white rounded-xl shadow-2xl p-6 md:p-10 border-t-8 border-indigo-700">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">
                    Pencarian Data Mahasiswa
                </h3>
                <form class="relative" action="#" method="GET"> 
                    <input 
                        type="search" 
                        placeholder="Kata kunci: [Nama] [NIM] [Prodi]" 
                        class="w-full p-4 pr-12 border border-gray-300 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-lg"
                        aria-label="Cari mahasiswa"
                        name="search_query"
                    >
                    <button 
                        type="submit" 
                        class="absolute right-0 top-0 h-full flex items-center justify-center pr-4 text-indigo-600 hover:text-indigo-300 transition-colors duration-200"
                        aria-label="Tombol Cari"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>

                <div class="pb-20"></div>
            
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-6 border-b pb-2">
                    Statistik Data Mahasiswa UNS
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-indigo-600">
                        <p class="text-sm text-gray-500 font-semibold uppercase">Total Mahasiswa Terdaftar</p>
                        <p class="text-5xl font-bold text-gray-900 mt-2">{{ $total_mahasiswa ?? '5' }}</p>
                        <p class="text-sm text-indigo-500 mt-2">Data kumulatif seluruh angkatan.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-600">
                        <p class="text-sm text-gray-500 font-semibold uppercase">Mahasiswa Aktif Saat Ini</p>
                        <p class="text-5xl font-bold text-gray-900 mt-2">{{ $mahasiswa_aktif ?? '2' }}</p>
                        <p class="text-sm text-green-500 mt-2">Status: Aktif.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-orange-600">
                        <p class="text-sm text-gray-500 font-semibold uppercase">Lulusan / Alumni</p>
                        <p class="text-5xl font-bold text-gray-900 mt-2">{{ $mahasiswa_lulus ?? '1' }}</p>
                        <p class="text-sm text-orange-500 mt-2">Status: Lulus.</p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4 pt-4 border-t border-gray-200">
                    Distribusi Status Mahasiswa
                </h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    <div class="p-4 bg-gray-50 rounded-lg shadow-inner">
                        <p class="text-4xl font-extrabold text-blue-600">{{ $mahasiswa_aktif ?? '2' }}</p>
                        <p class="text-sm text-gray-600 mt-1">Aktif</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg shadow-inner">
                        <p class="text-4xl font-extrabold text-yellow-600">{{ $mahasiswa_cuti ?? '1' }}</p>
                        <p class="text-sm text-gray-600 mt-1">Cuti</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg shadow-inner">
                        <p class="text-4xl font-extrabold text-red-600">{{ $mahasiswa_mengundurkan_diri ?? '1' }}</p>
                        <p class="text-sm text-gray-600 mt-1">Mengundurkan Diri</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg shadow-inner">
                        <p class="text-4xl font-extrabold text-indigo-600">{{ $mahasiswa_lulus ?? '1' }}</p>
                        <p class="text-sm text-gray-600 mt-1">Lulus</p>
                    </div>
                </div>
            </section>

        </div>
    </main>

    <footer class="relative z-10 bg-white py-6 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500">
            &copy; Copyright &copy; 2025 SIMUNS.
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            const scrollPos = window.scrollY;
            const maxScroll = 250;
            let opacity = Math.min(scrollPos / maxScroll, 1);
            header.style.backgroundColor = `rgba(49, 46, 129, ${opacity})`; 
        });
    </script>

</body>
</html>