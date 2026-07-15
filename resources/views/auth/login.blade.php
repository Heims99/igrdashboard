<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - NGF IGR Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS (using standard CDN for standalone if tailwind is not compiled yet, but we also include the vite directives) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #064e3b 0%, #022c22 100%);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-center items-center p-6 text-slate-100 font-sans antialiased">
    <!-- Main login card -->
    <div class="w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl p-8 flex flex-col items-center">
        <!-- Logo -->
        <div class="mb-6 flex justify-center">
            <!-- Representing the NGF logo styling -->
            <div class="h-16 w-16 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg shadow-emerald-500/30">
                <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                </svg>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-center mb-1 text-white tracking-tight">Nigeria Governors' Forum</h2>
        <p class="text-emerald-400 text-sm font-medium mb-8 text-center uppercase tracking-wider">IGR Dashboard Management</p>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="w-full space-y-5">
            @csrf
            
            <!-- State/Username Field -->
            <div>
                <label for="state" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">State / Login Identifier</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </span>
                    <input type="text" name="state" id="state" placeholder="e.g. Abia or NGF" required value="{{ old('state') }}"
                           class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl py-3 pl-10 pr-4 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                </div>
                @error('state')
                    <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Password</label>
                    <span class="text-[10px] text-slate-400 italic">Case sensitive</span>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                           class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl py-3 pl-10 pr-4 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                </div>
                @error('password')
                    <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-emerald-500 hover:bg-emerald-400 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-emerald-500/20 active:scale-[0.98] transition duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 focus:ring-offset-slate-900">
                Sign In
            </button>
        </form>

        <!-- Extra links -->
        <div class="mt-8 text-center space-y-2">
            <a href="mailto:info@nggovernorsforum.org" class="block text-xs text-slate-400 hover:text-emerald-400 hover:underline transition duration-150">
                Contact Dashboard Manager
            </a>
            <a href="/" class="block text-xs text-slate-500 hover:text-slate-300 hover:underline transition duration-150">
                &larr; Back to Public Dashboard
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-8 text-center text-xs text-slate-500">
        &copy; 2016 - {{ date('Y') }} Nigeria Governors' Forum. All rights reserved.
    </footer>
</body>
</html>
