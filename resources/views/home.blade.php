<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Mahasiswa (Parallax)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <header id="mainHeader" class="fixed top-0 left-0 w-full z-50 py-4"> 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-5xl font-extrabold text-white" id="headerTitle">
                SIMUNS
            </h1>
            
            {{-- LOGIKA TOMBOL DINAMIS --}}
            <div class="flex items-center space-x-2">
                @auth 
                    {{-- TAMPILKAN JIKA SUDAH LOGIN --}}
                    
                    {{-- Tampilkan Nama User --}}
                    <span class="text-white text-md font-medium hidden sm:inline-block">
                        Halo, {{ Auth::user()->nama ?? 'Mahasiswa' }}!
                    </span>

                    {{-- Tombol Profil --}}
                    <a href="{{ route('profile') }}" class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-2 px-4 sm:px-6 rounded-l-full transition-all duration-300 shadow-lg inline-flex items-center text-sm sm:text-base">
                        Profil
                    </a>
                    
                    {{-- Tombol Logout --}}
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white hover:bg-red-600 font-bold py-2 px-4 sm:px-6 rounded-r-full transition-all duration-300 shadow-lg text-sm sm:text-base">
                            Logout
                        </button>
                    </form>
                @endauth

                @guest
                    {{-- TAMPILKAN JIKA BELUM LOGIN --}}
                    <a href="{{ route('login') }}" class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-2 px-6 rounded-full transition-all duration-300 shadow-lg inline-flex items-center">
                        Login SIMUNS
                    </a>
                @endguest
            </div>
            {{-- AKHIR LOGIKA TOMBOL DINAMIS --}}
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

    <div class="h-40"></div>
    <div class="h-60"></div>

    <main class="w-full bg-white relative z-10 mx-auto p-8 lg:p-12">
        <div class="mb-12 max-w-4xl mx-auto">
            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-4">
                Pencarian Data Mahasiswa
            </h3>
            <form class="relative" action="#" method="GET"> 
                <input 
                    type="search" 
                    placeholder="Kata kunci: [Nama] [NIM] [Prodi] [Fakultas]" 
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
        </div>

        <section class="bg-white rounded-xl shadow-2xl p-6 md:p-10">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                Konten Utama Kami
            </h2>
            <p class="text-xl text-indigo-600 font-medium mb-8">
                Gulir ke bawah!
            </p>

            <div class="space-y-6 text-gray-700 leading-relaxed text-lg">
                <p>
                    <strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Vestibulum tristique, nunc vitae tristique pretium, libero quam pellentesque orci, vitae eleifend orci sem vel lacus.
                </p>
                <h3 class="text-2xl font-bold text-gray-800 pt-8">
                    Isi Tambahan
                </h3>
                <p>
                    Nullam facilisis leo a tellus rhoncus, sed ullamcorper quam maximus. Maecenas tristique, magna vel vehicula finibus, mi urna pulvinar odio, id eleifend odio tellus id nisl.
                </p>
            </div>
        </section>
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