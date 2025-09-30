<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SIMUNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    <header class="bg-indigo-700 text-white p-4 shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-white hover:text-indigo-100 transition duration-300 ease-in-out">
                <h1 class="text-5xl font-extrabold">
                    SIMUNS
                </h1>
            </a>
            
            <a href="{{ route('home') }}" class="bg-white hover:bg-indigo-100 text-indigo-700 font-bold py-2 px-4 rounded-full shadow-md transition duration-200 flex items-center text-base">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </header>
    
    @if (!isset($user))
        <div class="max-w-4xl mx-auto mt-12 p-6 text-center bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <p class="font-bold">Error: Data profil tidak ditemukan atau sesi sudah berakhir.</p>
        </div>
    @else
    <main class="max-w-4xl mx-auto mt-12">
        <div class="bg-white shadow-2xl rounded-xl p-8 md:p-12 border-t-4 border-indigo-600">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-8 border-b-2 pb-3">
                Profil Akun Mahasiswa
            </h2>
            
            <div class="space-y-6">
                <div class="flex flex-col sm:flex-row justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-500 font-medium sm:w-1/3">Nama Lengkap:</span>
                    <span class="text-gray-800 font-bold sm:w-2/3 text-right">{{ $user->nama }}</span>
                </div>
                
                <div class="flex flex-col sm:flex-row justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-500 font-medium sm:w-1/3">NIM (ID Login):</span>
                    <span class="text-gray-800 font-bold sm:w-2/3 text-right">{{ $user->nim }}</span>
                </div>
                
                <div class="flex flex-col sm:flex-row justify-between py-3">
                    <span class="text-gray-500 font-medium sm:w-1/3">Nama Akun:</span>
                    <span class="text-gray-800 font-bold sm:w-2/3 text-right">{{ $user->akun }}</span> 
                </div>
            </div>

            <div class="mt-10 flex justify-left items-center border-t pt-6">
                
                <form action="{{ route('logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </main>
    @endif

</body>
</html>