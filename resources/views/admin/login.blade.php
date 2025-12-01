<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SIMUNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Mengadopsi font Poppins agar konsisten dengan home.blade.php --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        .font-brand {
            font-family: 'Poppins', sans-serif;
        }
        body {
            /* Latar belakang yang lebih dinamis, diambil dari style SSO login */
            background-color: #f3ff6; /* bg-gray-100 */
            background-image: linear-gradient(135deg, #4f46e5 0%, #1e3a8a 100%); /* Warna Indigo */
        }
        .login-card {
            /* Style card yang lebih modern */
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); /* Bayangan lebih dalam */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen font-brand antialiased">

    <div class="w-full max-w-md p-4">
        
        {{-- Card Login Modern --}}
        <div class="bg-white login-card rounded-2xl p-8 md:p-10 border-t-8 border-pink-500/90">
            
            <div class="text-center mb-8">
                {{-- Ikon Kunci/Gembok untuk Admin --}}
                <svg class="w-12 h-12 mx-auto text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <h1 class="text-3xl font-extrabold text-gray-900 mt-3">
                    Admin SIMUNS
                </h1>
                <p class="text-gray-500 mt-1">Akses Khusus Pengelola Sistem</p>
            </div>
            
            <form action="{{ route('admin.login.attempt') }}" method="POST"> 
                @csrf 
                
                {{-- Kolom Username --}}
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="username">
                        Username Admin
                    </label>
                    <input 
                        class="appearance-none border-2 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight transition duration-150 focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 @error('username') border-red-500 bg-red-50 @enderror" 
                        id="username" 
                        name="username" 
                        type="text" 
                        placeholder="Masukkan Username" 
                        value="{{ old('username') }}"
                        required
                    >
                    @error('username')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Kolom Password --}}
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                        Password
                    </label>
                    <input 
                        class="appearance-none border-2 rounded-xl w-full py-3 px-4 text-gray-700 leading-tight transition duration-150 focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 @error('password') border-red-500 bg-red-50 @enderror" 
                        id="password" 
                        name="password" 
                        type="password" 
                        placeholder="********"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Login dan Link Kembali --}}
                <div class="flex flex-col space-y-3">
                    
                    {{-- Tombol Login Admin (Warna Pink/Accent) --}}
                    <button 
                        class="bg-pink-600 hover:bg-pink-700 text-white font-extrabold py-3 px-4 rounded-xl shadow-lg shadow-pink-500/50 focus:outline-none focus:ring-4 focus:ring-pink-500/50 transition duration-200 flex items-center justify-center text-lg" 
                        type="submit"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Masuk sebagai Admin
                    </button>
                    
                    {{-- Link: Kembali ke Home --}}
                    <a href="{{ route('home') }}" class="text-center text-sm font-semibold text-gray-500 hover:text-indigo-600 transition duration-150 mt-2">
                        &larr; Kembali ke Beranda
                    </a>
                </div>
            </form>
            
        </div>
        <p class="text-center text-white text-xs mt-6 opacity-70">
            Halaman Login Administrasi SIMUNS. Hanya untuk Pengguna Terdaftar.
        </p>
    </div>

</body>
</html>