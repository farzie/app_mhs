<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - SIMUNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .profile-card {
            box-shadow: 0 15px 30px rgba(49, 46, 129, 0.1); /* Bayangan Biru-Indigo Lembut */
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    <header class="bg-indigo-800 text-white p-4 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            
            <a href="{{ route('home') }}" class="text-white hover:text-indigo-200 transition duration-300 ease-in-out flex items-center">
                <svg class="w-8 h-8 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"></path></svg>
                <h1 class="text-3xl font-extrabold tracking-tight">
                    SIMUNS
                </h1>
            </a>
            
            <a href="{{ url('/') }}" class="bg-white text-indigo-700 hover:bg-indigo-50 font-extrabold py-2 px-6 rounded-full transition-colors duration-300 shadow-xl inline-flex items-center tracking-wide text-sm sm:text-base">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Beranda
            </a>
        </div>
    </header>
    
    <div class="max-w-4xl mx-auto pt-12 pb-20 px-4 sm:px-6 lg:px-8">
        
        @if (!isset($user))
            <div class="mt-8 p-6 text-center bg-red-50 border-l-4 border-red-500 text-red-800 rounded-lg shadow-md" role="alert">
                <p class="font-extrabold text-xl mb-2 flex items-center justify-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.3 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Data Tidak Ditemukan
                </p>
                <p>Profil mahasiswa gagal dimuat. Pastikan Anda sudah login atau data yang diminta tersedia.</p>
            </div>
        @else
        <main>
            <div class="bg-white profile-card rounded-2xl p-6 md:p-10 border-t-8 border-indigo-600/90">
                <div class="flex items-start justify-between border-b pb-4 mb-6">
                    <h2 class="text-3xl font-extrabold text-gray-900 flex items-center">
                        <svg class="w-7 h-7 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Detail Profil Akun
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 gap-6">

                    <div class="p-4 bg-indigo-50 rounded-lg border border-indigo-200/50">
                        <p class="text-sm font-medium text-indigo-600 mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Nama Lengkap
                        </p>
                        <p class="text-xl font-extrabold text-gray-900">{{ $user->nama ?? 'N/A' }}</p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-600 mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            NIM (Nomor Induk Mahasiswa)
                        </p>
                        <p class="text-xl font-extrabold text-gray-900">{{ $user->nim ?? 'N/A' }}</p>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-600 mb-1 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2v2m-4-2H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2v-2m-4-2h.01M17 10h.01"></path></svg>
                            Nama Akun / Username
                        </p>
                        <p class="text-xl font-extrabold text-gray-900">{{ $user->akun ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100 flex justify-end">
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition duration-200 flex items-center text-base">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </main>
        @endif

    </div>
    <footer class="relative z-10 bg-gray-900 py-8 border-t border-indigo-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            <p class="text-lg font-bold text-white mb-2">SIMUNS</p>
            <p>&copy; Copyright 2025. Sistem Informasi Mahasiswa Universitas Sebelas Maret.</p>
        </div>
    </footer>
</body>
</html>