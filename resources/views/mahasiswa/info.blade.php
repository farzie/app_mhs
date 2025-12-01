<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa: {{ $mahasiswa->nama }}</title>
    <meta name="theme-color" content="#4c51bf">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mengadopsi font Poppins dari home.blade.php */
        .font-brand {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>
{{-- Menggunakan font-brand, background body abu-abu --}}
<body class="bg-white font-brand antialiased min-h-screen">
    
    {{-- HEADER (Konsisten dengan home.blade.php) --}}
    <header id="mainHeader" class="fixed top-0 left-0 w-full z-50 py-3 bg-indigo-900 shadow-xl shadow-indigo-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            
            <a href="{{ url('/') }}" class="text-white hover:text-indigo-200 transition duration-300 ease-in-out flex items-center">
                <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                <h1 class="text-3xl font-extrabold tracking-tight">
                    SIMUNS
                </h1>
            </a>
            
            <a href="{{ url()->previous() }}" class="bg-white text-indigo-700 hover:bg-indigo-50 font-extrabold py-2 px-6 rounded-full transition-colors duration-300 shadow-xl inline-flex items-center tracking-wide text-sm sm:text-base">
                &larr; Kembali
            </a>
        </div>
    </header>

    <main class="w-full relative z-10 mx-auto py-12 pt-[100px] md:pt-[120px]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- 1. BAGIAN JUDUL UTAMA (Full Width Bar) --}}
            <section class="mb-10 py-6 border-b-4 border-indigo-600 bg-white/70 backdrop-blur-sm -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-2">
                    {{ $mahasiswa->nama }}
                </h1>
                
                {{-- Detail Nim dan Prodi --}}
                <div class="flex flex-wrap items-center space-x-4 text-xl font-medium text-gray-700">
                    <span class="font-bold text-indigo-700">
                        NIM: {{ $mahasiswa->nim }}
                    </span>
                    <span class="text-gray-500">
                        &middot;
                    </span>
                    <span class="text-pink-700 font-semibold">
                        {{ $mahasiswa->jenjang_prodi }}
                    </span>
                </div>
            </section>
            
            {{-- 2. STATUS AKADEMIK (Dipisahkan dengan garis) --}}
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 pb-2 border-b-2 border-gray-300 flex items-center">
                    <svg class="w-7 h-7 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.24L12 17.25m-1.25-1.25L5.382 7.76"></path></svg>
                    Status Akademik Saat Ini
                </h2>
                
                <div class="py-4 border-l-4 border-green-500 pl-4 bg-white/50">
                    <p class="text-4xl font-extrabold text-green-700">{{ $mahasiswa->status_saat_ini }}</p>
                    <p class="text-base text-gray-500 mt-1">Status resmi mahasiswa per semester ini, dicatat dalam sistem SIMUNS.</p>
                </div>
            </section>

            {{-- 3. INFORMASI DETAIL (Menggunakan List Deskripsi) --}}
            <section class="mb-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b-2 border-gray-300 flex items-center">
                    <svg class="w-7 h-7 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Detail Informasi
                </h2>
                
                <dl class="text-gray-700">
                    
                    {{-- Tanggal Masuk --}}
                    <div class="py-4 border-b border-gray-200 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <dt class="text-lg font-medium text-gray-500">Tanggal Masuk</dt>
                        <dd class="text-lg font-semibold text-gray-900 sm:col-span-2">
                            {{ date('d F Y', strtotime($mahasiswa->tanggal_masuk)) }}
                        </dd>
                    </div>

                    {{-- Semester Awal --}}
                    <div class="py-4 border-b border-gray-200 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <dt class="text-lg font-medium text-gray-500">Semester Awal</dt>
                        <dd class="text-lg font-semibold text-gray-900 sm:col-span-2">
                            {{ $mahasiswa->semester_awal }}
                        </dd>
                    </div>

                    {{-- Status Awal Mhs --}}
                    <div class="py-4 border-b border-gray-200 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <dt class="text-lg font-medium text-gray-500">Status Awal Masuk</dt>
                        <dd class="text-lg font-semibold text-yellow-700 sm:col-span-2">
                            {{ $mahasiswa->status_awal_mhs }}
                        </dd>
                    </div>
                    
                    {{-- Jenis Kelamin --}}
                    <div class="py-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <dt class="text-lg font-medium text-gray-500">Jenis Kelamin</dt>
                        <dd class="text-lg font-semibold text-gray-900 sm:col-span-2">
                            {{ $mahasiswa->jenis_kelamin }}
                        </dd>
                    </div>
                </dl>
            </section>
            
        </div>
    </main>

    {{-- FOOTER (Konsisten dengan home.blade.php) --}}
    <footer class="relative z-10 bg-gray-900 py-8 border-t border-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            <p class="text-lg font-bold text-white mb-2">SIMUNS</p>
            <p>&copy; Copyright 2025. Sistem Informasi Mahasiswa Universitas Sebelas Maret.</p>
        </div>
    </footer>
</body>
</html>