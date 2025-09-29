<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SIMUNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md">
        <div class="bg-white shadow-2xl rounded-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">
                Admin SIMUNS
            </h2>
            <form action="{{ route('admin.login.attempt') }}" method="POST"> 
                @csrf 
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-indigo-500 @error('username') border-indigo-500 @enderror" 
                        id="username" name="username" type="text" placeholder="Admin Username" value="{{ old('username') }}">
                    @error('username')
                        <p class="text-indigo-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-indigo-500 @error('password') border-indigo-500 @enderror" 
                        id="password" name="password" type="password" placeholder="********">
                    @error('password')
                        <p class="text-indigo-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150" type="submit">
                        Masuk Admin
                    </button>
                    <a href="{{ route('home') }}" class="inline-block align-baseline font-bold text-sm text-indigo-600 hover:text-indigo-800">
                        &larr; Ke Halaman Utama
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>