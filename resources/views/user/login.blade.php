<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SSO - SIMUNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Latar belakang yang lebih dinamis */
            background-color: #f3f4f6; /* bg-gray-100 */
            background-image: linear-gradient(135deg, #4f46e5 0%, #1e3a8a 100%); /* Warna Indigo */
            
        }
        .login-card {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15); /* Bayangan lebih dalam */
            transition: none;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-4">
        
        <div class="bg-white login-card rounded-2xl p-8 md:p-10 border-t-8 border-indigo-600/90">
            
            <div class="text-center mb-8">
                <svg class="w-12 h-12 mx-auto text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                <h1 class="text-3xl font-extrabold text-gray-900 mt-3">
                    SIMUNS Login SSO
                </h1>
                <p class="text-gray-500 mt-1">Akses Sistem Informasi Mahasiswa</p>
            </div>
            
            <form action="{{ route('login.attempt') }}" method="POST"> 
                @csrf 
                
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                        <span class="text-indigo-600 mr-1">*</span> Email Akun Mahasiswa
                    </label>
                    <input 
                        class="appearance-none border-2 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight transition duration-150 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 @error('email') border-red-500 bg-red-50 @enderror" 
                        id="email" 
                        name="email" 
                        type="text" {{-- Diubah ke text karena input akan diserahkan sebagai 'akun' yang mencakup @student.uns.ac.id --}}
                        placeholder="contoh@student.uns.ac.id" 
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                        <span class="text-indigo-600 mr-1">*</span> NIM Anda
                    </label>
                    <input 
                        class="appearance-none border-2 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight transition duration-150 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 @error('password') border-red-500 bg-red-50 @enderror" 
                        id="password" 
                        name="password" 
                        type="password" 
                        placeholder="K35XXXXX"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- OPSI TOMBOL BARU, Dibuat konsisten dengan register.blade.php --}}
                <div class="flex flex-col space-y-3">
                    
                    {{-- Tombol 1: Primary Action (Login) --}}
                    <button 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/50 focus:outline-none focus:ring-4 focus:ring-indigo-500/50 transition duration-200 flex items-center justify-center text-lg" 
                        type="submit"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Masuk ke SIMUNS
                    </button>
                    
                    {{-- Tombol 2: Secondary Action Daftar --}}
                    <a href="{{ route('register') }}" 
                        class="text-center bg-white hover:bg-gray-50 text-indigo-700 border-2 border-indigo-600 font-bold py-3 px-4 rounded-xl shadow-md focus:outline-none focus:ring-4 focus:ring-indigo-500/20 transition duration-200 flex items-center justify-center text-md"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Belum punya akun? Daftar
                    </a>

                    {{-- Link: Kembali ke Home --}}
                    <a href="{{ route('home') }}" class="text-center text-sm font-semibold text-gray-500 hover:text-indigo-600 transition duration-150 mt-2">
                        &larr; Kembali ke Beranda
                    </a>
                </div>
            </form>
            
        </div>
        <p class="text-center text-white text-xs mt-6 opacity-70">
            SIMUNS - Sistem Informasi Mahasiswa UNS. Pastikan Anda menggunakan akun resmi.
        </p>
    </div>

</body>
</html>