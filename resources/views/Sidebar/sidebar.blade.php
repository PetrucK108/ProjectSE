<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FutsalMatcher</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex">
    <div
        class="w-64 h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white flex flex-col fixed top-0 left-0 shadow-lg z-50">

        <!-- Logo -->
        <div class="p-6 flex items-center justify-center border-b border-gray-700">
            <a href="{{ route('home') }}"
                class="text-2xl font-extrabold text-cyan-400 hover:text-cyan-300 transition duration-300">
                Futsal Matcher
            </a>
        </div>

        <!-- User Info -->
        <div class="p-6 flex flex-col items-center border-b border-gray-700">
            <img src="{{ asset('images/yasi.jpg') }}" alt="User Avatar"
                class="rounded-full w-24 h-24 object-cover border-4 border-cyan-400 shadow-lg">
            <h2 class="text-lg font-semibold mt-3">{{ Auth::user()->name ?? 'PetrucK' }}</h2>
            <p class="text-sm text-gray-400">{{ Auth::user()->email ?? 'PetrucK@example.com' }}</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('profil') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        d="M5.121 17.804A11.966 11.966 0 0112 15c2.21 0 4.262.636 5.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="ml-3">Profil Tim</span>
            </a>
            <a href="{{ route('find') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                </svg>
                <span class="ml-3">Find</span>
            </a>
            <a href="{{ route('message') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M8 10h.01M12 10h.01M16 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ml-3">Message</span>
            </a>
            <a href="{{ route('recent-matches') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M4 4v5h.582m15.418 0a9 9 0 11-3.845-7.599M12 7v5l3 3" />
                </svg>
                <span class="ml-3">Recent Matches</span>
            </a>
            <a href="{{ route('sewa') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7H3zM16 3h-4a1 1 0 00-1 1v3h6V4a1 1 0 00-1-1z" />
                </svg>
                <span class="ml-3">Sewa Lapangan</span>
            </a>

            <!-- Login / Logout -->
            <div class="mt-auto px-4 py-6 border-t border-gray-700">
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2 mt-4 rounded-xl bg-gray-800 text-white hover:bg-cyan-600 transition-all duration-500 ease-in-out hover:tracking-widest hover:scale-105 shadow-inner shadow-cyan-800/40">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full flex items-center justify-center py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M15 12H3m0 0l4-4m-4 4l4 4m6-4v1a2 2 0 002 2h4a2 2 0 002-2V7a2 2 0 00-2-2h-4a2 2 0 00-2 2v1" />
                        </svg>
                        Login
                    </a>
                @endif
            </div>
        </nav>
    </div>

    <div class="flex-1 p-8 bg-gray-50 min-h-screen ml-64">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 shadow-md">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>

</body>
</html>
