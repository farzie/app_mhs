<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-8 md:p-10">

        @if (session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg font-medium" role="alert">
                <p>{{ session('status') }}</p>
            </div>
        @endif

        {{-- ======================================================= --}}
        {{-- PROTECTED VIEW: Displayed ONLY if the user is logged in --}}
        {{-- ======================================================= --}}
        @auth
            <div class="text-center py-6">
                <h1 class="text-4xl font-extrabold text-blue-600 mb-4">
                    Welcome Back, {{ Auth::user()->name }}! 🥳
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    You're logged in and viewing protected content.
                </p>

                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 transition duration-300">
                        Logout
                    </button>
                </form>
            </div>
        @endauth

        {{-- ========================================================== --}}
        {{-- PUBLIC VIEW: Displayed ONLY if the user is NOT logged in --}}
        {{-- ========================================================== --}}
        @guest
            <h1 class="text-3xl font-bold text-gray-800 text-center mb-6">
                App Access 🔑
            </h1>
            
            <div class="mb-6 flex justify-center space-x-2 p-1 bg-gray-200 rounded-lg">
                <button 
                    id="login-tab" 
                    onclick="switchView('login')" 
                    class="view-tab flex-1 py-2 rounded-lg font-semibold transition duration-200 bg-teal-600 text-white shadow-md">
                    Sign In
                </button>
                <button 
                    id="register-tab" 
                    onclick="switchView('register')" 
                    class="view-tab flex-1 py-2 rounded-lg font-semibold transition duration-200 text-gray-700 hover:bg-white">
                    Register
                </button>
            </div>
            
            {{-- --- SIGN IN FORM --- --}}
            <div id="login-container" class="form-container block">
                <div class="p-6 border-4 border-teal-300 rounded-xl shadow-lg bg-teal-50">
                    <h2 class="text-2xl font-bold text-teal-800 mb-6 pb-2 border-b-2 border-teal-300">Sign In to Your Account</h2>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="login-email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="login-email" name="email" value="{{ old('email') }}" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="login-password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="login-password" name="password" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        </div>

                        <div class="mb-8 flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>

                        <button type="submit" class="w-full py-3 px-4 border border-transparent rounded-lg shadow-lg text-lg font-semibold text-white bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 transform hover:scale-[1.01]">
                            Log In
                        </button>
                    </form>
                </div>
            </div>

            {{-- --- REGISTER FORM --- --}}
            <div id="register-container" class="form-container hidden">
                <div class="p-6 border-4 border-indigo-300 rounded-xl shadow-lg bg-indigo-50">
                    <h2 class="text-2xl font-bold text-indigo-800 mb-6 pb-2 border-b-2 border-indigo-300">Create New Account</h2>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="register-email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="register-email" name="email" value="{{ old('email') }}" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="register-password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="register-password" name="password" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <button type="submit" class="w-full py-3 px-4 border border-transparent rounded-lg shadow-lg text-lg font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 transform hover:scale-[1.01]">
                            Register Account
                        </button>
                    </form>
                </div>
            </div>
        @endguest
    </div>
    
    <script>
        const loginContainer = document.getElementById('login-container');
        const registerContainer = document.getElementById('register-container');
        const loginTab = document.getElementById('login-tab');
        const registerTab = document.getElementById('register-tab');

        // Define class constants for clarity and easy maintenance
        const ACTIVE_LOGIN_CLASSES = ['bg-teal-600', 'text-white', 'shadow-md'];
        const INACTIVE_CLASSES = ['bg-gray-200', 'text-gray-700', 'hover:bg-white'];
        const ACTIVE_REGISTER_CLASSES = ['bg-indigo-600', 'text-white', 'shadow-md'];

        function switchView(view) {
            if (view === 'login') {
                // Show Login form, hide Register form
                loginContainer.classList.remove('hidden');
                registerContainer.classList.add('hidden');
                
                // Set Login tab to active
                loginTab.classList.add(...ACTIVE_LOGIN_CLASSES);
                loginTab.classList.remove(...INACTIVE_CLASSES);

                // Set Register tab to inactive
                registerTab.classList.add(...INACTIVE_CLASSES);
                // FIX: Remove the active indigo classes when switching away from register
                registerTab.classList.remove(...ACTIVE_REGISTER_CLASSES); 

            } else {
                // Show Register form, hide Login form
                loginContainer.classList.add('hidden');
                registerContainer.classList.remove('hidden');

                // Set Register tab to active
                registerTab.classList.add(...ACTIVE_REGISTER_CLASSES);
                registerTab.classList.remove(...INACTIVE_CLASSES);
                
                // Set Login tab to inactive
                loginTab.classList.add(...INACTIVE_CLASSES);
                loginTab.classList.remove(...ACTIVE_LOGIN_CLASSES);
            }
        }

        // Check for validation errors on page load and switch to the correct tab if needed
        document.addEventListener('DOMContentLoaded', () => {
            const hasRegisterErrors = document.querySelector('#register-container .border-red-500');
            const hasLoginErrors = document.querySelector('#login-container .border-red-500');
            const nameInputFilled = document.getElementById('name') && document.getElementById('name').value;

            // Default to login view unless registration errors/old input force the register view
            if (hasRegisterErrors || nameInputFilled) {
                switchView('register');
            } else {
                switchView('login');
            }
        });
    </script>
</body>
</html>