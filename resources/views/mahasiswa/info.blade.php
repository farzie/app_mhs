<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa: {{ $mahasiswa->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gaya dasar untuk card utama */
        .main-info-card {
            transition: box-shadow 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased pt-[120px] md:pt-[100px]">
    
    <header id="mainHeader" class="fixed top-0 left-0 w-full z-50 py-4 bg-indigo-700 shadow-xl"> 
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-white hover:text-indigo-100 transition duration-300 ease-in-out">
                <h1 class="text-4xl md:text-5xl font-extrabold">
                    SIMUNS
                </h1>
            </a>
            
            <div class="flex items-center space-x-2">
                <a href="{{ url('/') }}" class="bg-white text-indigo-600 hover:bg-indigo-100 font-bold py-2 px-4 sm:px-6 rounded-full transition-all duration-300 shadow-lg inline-flex items-center text-sm sm:text-base">
                    Ke Beranda
                </a>
            </div>
        </div>
    </header>

    <main class="w-full relative z-10 mx-auto py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <a href="{{ url()->previous() }}" class="text-indigo-600 hover:text-indigo-800 mb-6 inline-flex items-center font-semibold transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Hasil Pencarian
            </a>

            <div class="bg-white rounded-xl shadow-2xl overflow-hidden main-info-card">
                
                {{-- Bagian Header Nama & Prodi --}}
                <div class="p-6 md:p-8 bg-indigo-700 text-white">
                    <p class="text-sm font-light opacity-80">Nomor Induk Mahasiswa (NIM)</p>
                    <h2 class="text-3xl font-light mb-1">{{ $mahasiswa->nim }}</h2>
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                        {{ $mahasiswa->nama }}
                    </h1>
                    <span class="inline-block mt-3 px-3 py-1 text-base font-semibold bg-indigo-500 rounded-full shadow-md">
                        {{ $mahasiswa->jenjang_prodi }}
                    </span>
                </div>

                {{-- Bagian Detail Data (Grid) --}}
                <div class="p-6 md:p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Informasi Akademik</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-6 text-gray-700">
                        
                        {{-- KOLOM KIRI (Status, Tanggal Masuk, Semester Awal) --}}
                        <div class="space-y-4">
                            
                            {{-- Status Aktif --}}
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-medium">Status Saat Ini:</span>
                                <span class="font-bold text-green-600">{{ $mahasiswa->status_saat_ini }}</span>
                            </div>
                            
                            {{-- Tanggal Masuk --}}
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-medium">Tanggal Masuk:</span>
                                <span>{{ date('d F Y', strtotime($mahasiswa->tanggal_masuk)) }}</span>
                            </div>

                            {{-- Semester Awal --}}
                            <div class="flex justify-between">
                                <span class="font-medium">Semester Awal:</span>
                                <span>{{ $mahasiswa->semester_awal }}</span>
                            </div>
                        </div>

                        {{-- KOLOM KANAN (Jenis Kelamin, Status Awal Mhs) --}}
                        <div class="space-y-4">
                            
                            {{-- Jenis Kelamin --}}
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-medium">Jenis Kelamin:</span>
                                <span>{{ $mahasiswa->jenis_kelamin }}</span>
                            </div>

                            {{-- Status Awal Mhs --}}
                            <div class="flex justify-between border-b pb-2">
                                <span class="font-medium">Status Awal Mhs:</span>
                                <span class="font-semibold text-yellow-700">{{ $mahasiswa->status_awal_mhs }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </main>

    <footer class="relative z-10 bg-white py-6 border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500">
            &copy; Copyright &copy; 2025 SIMUNS.
        </div>
    </footer>
</body>
</html>