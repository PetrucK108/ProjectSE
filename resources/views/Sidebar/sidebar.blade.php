<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FutsalMatcher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .sidebar-transition {
            transition: width 0.35s cubic-bezier(.4,0,.2,1), min-width 0.35s cubic-bezier(.4,0,.2,1), max-width 0.35s cubic-bezier(.4,0,.2,1), box-shadow 0.3s;
        }
        .sidebar-collapsed {
            width: 64px !important;
            min-width: 64px !important;
            max-width: 64px !important;
            box-shadow: 0 0 0 0 transparent !important;
        }
        .sidebar-collapsed .sidebar-label {
            opacity: 0;
            width: 0;
            padding: 0;
            margin: 0;
            transition: opacity 0.25s cubic-bezier(.4,0,.2,1), width 0.25s cubic-bezier(.4,0,.2,1), padding 0.25s cubic-bezier(.4,0,.2,1), margin 0.25s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-label {
            opacity: 1;
            transition: opacity 0.25s cubic-bezier(.4,0,.2,1);
            white-space: nowrap;
            display: inline-block;
        }
        .sidebar-collapsed .sidebar-profile-img,
        .sidebar-collapsed .sidebar-logo {
            opacity: 0 !important;
            pointer-events: none !important;
            visibility: hidden !important;
            transition: opacity 0.35s cubic-bezier(.4,0,.2,1), visibility 0.35s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-profile-img,
        .sidebar-logo {
            opacity: 1;
            transition: opacity 0.35s cubic-bezier(.4,0,.2,1), visibility 0.35s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-collapsed .sidebar-profile-box {
            min-height: 0 !important;
            padding: 0 !important;
        }
        .sidebar-profile-box {
            min-height: 120px;
            transition: min-height 0.35s cubic-bezier(.4,0,.2,1), padding 0.35s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-collapsed .sidebar-profile-name-box {
            max-height: 0 !important;
            opacity: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            transition: max-height 0.35s cubic-bezier(.4,0,.2,1), opacity 0.35s cubic-bezier(.4,0,.2,1), margin 0.35s, padding 0.35s;
        }
        .sidebar-profile-name-box {
            max-height: 60px;
            opacity: 1;
            transition: max-height 0.35s cubic-bezier(.4,0,.2,1), opacity 0.35s cubic-bezier(.4,0,.2,1), margin 0.35s, padding 0.35s;
        }
        .sidebar-collapsed .sidebar-nav {
            align-items: center !important;
        }
        .sidebar-nav {
            transition: align-items 0.2s;
        }
        /* Per-huruf animasi */
        .sidebar-label .sidebar-letter {
            opacity: 0;
            display: inline-block;
            transform: translateY(10px);
            transition: opacity 0.25s cubic-bezier(.4,0,.2,1), transform 0.25s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-label.animated .sidebar-letter {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="flex min-h-screen w-full">
    <div id="sidebar"
        class="sidebar-transition w-64 min-w-[200px] max-w-xs h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white flex flex-col fixed top-0 left-0 shadow-lg z-50 flex-shrink-0"
        onmouseenter="expandSidebar()" onmouseleave="collapseSidebar()">
        <!-- Logo -->
        <div class="p-6 flex items-center justify-center border-b border-gray-700 sidebar-logo">
            <a href="javascript:void(0)" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Futsal Matcher Logo" class="h-24 object-contain">
            </a>
        </div>
        @php
            $user = Auth::user();
            $defaultPhoto = asset('images/default-user.png');
            $profilePhoto = ($user && $user->foto_profil) ? asset('storage/' . $user->foto_profil) : $defaultPhoto;
        @endphp
        <div class="p-4 border-b border-gray-700 flex flex-col items-center justify-center sidebar-profile-box">
            <img src="{{ $profilePhoto }}" class="w-20 h-20 rounded-full object-cover border-2 border-cyan-400 sidebar-profile-img" alt="Foto Profil Tim">
            @if($user)
                <div class="mt-4 w-full flex justify-center sidebar-profile-name-box">
                    <div
                        class="transition-all duration-300 ease-in-out bg-gradient-to-r via-gray-800 to-gray-900 shadow-lg rounded-xl px-4 py-2 text-white font-semibold text-center w-full hover:scale-105 hover:shadow-2xl leading-tight whitespace-normal break-words"
                        style="box-shadow: 0 4px 16px 0 rgba(31,41,55,0.18), 0 2px 8px 0 rgba(31,41,55,0.13); min-height:2.5rem; max-height:4.5rem; display:flex; align-items:center; justify-content:center;"
                        title="{{ $user->name }}">
                        <span class="w-full block text-lg sidebar-profile-name" style="word-break:break-word; line-height:1.2; font-size:clamp(0.85rem,2vw,1.25rem);">
                            {{ $user->name }}
                        </span>
                    </div>
                </div>
            @endif
        </div>


        <!-- Navigation -->
        <nav class="sidebar-nav flex-1 px-4 py-6 space-y-2 flex flex-col">
            <a href="{{ route('profil') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <!-- User/Team Profile Icon -->
                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
                    <path d="M4 20c0-3.314 3.134-6 7-6s7 2.686 7 6" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <span class="ml-3 sidebar-label" data-label="Profile"></span>
            </a>
            <a href="{{ route('find') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <!-- Tetap pakai icon search -->
                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                </svg>
                <span class="ml-3 sidebar-label" data-label="Find"></span>
            </a>
            <a href="{{ route('message') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <!-- Chat Bubble Icon (modern) -->
                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
                <span class="ml-3 sidebar-label" data-label="Message"></span>
            </a>
            <a href="{{ route('recent-matches') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <!-- Tetap pakai icon match custom -->
                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0" fill="currentColor" viewBox="0 0 32 32">
                    <g>
                        <circle cx="10" cy="10" r="3.5"/>
                        <circle cx="22" cy="10" r="3.5"/>
                        <path d="M6 25v-2.5c0-2.5 2-4.5 4.5-4.5s4.5 2 4.5 4.5V25" />
                        <path d="M25 25v-2.5c0-2.5-2-4.5-4.5-4.5-1.2 0-2.3.4-3.1 1.2" />
                        <path d="M13.5 13.5c.7 1.2 2.3 2 4 2" />
                    </g>
                </svg>
                <span class="ml-3 sidebar-label" data-label="Match"></span>
            </a>
            <a href="{{ route('sewa') }}"
                class="flex items-center py-2 px-4 rounded-lg hover:bg-cyan-600/80 hover:text-white transition duration-200">
                <!-- Tetap pakai icon field/booking -->
                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7H3zM16 3h-4a1 1 0 00-1 1v3h6V4a1 1 0 00-1-1z" />
                </svg>
                <span class="ml-3 sidebar-label" data-label="Field Booking"></span>
            </a>
            <!-- Login / Logout -->
            <div class="mt-auto px-4 py-6 border-t border-gray-700">
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2 mt-4 rounded-xl bg-gray-800 text-white hover:bg-cyan-600 transition-all duration-500 ease-in-out hover:tracking-widest hover:scale-105 shadow-inner shadow-cyan-800/40">
                            <!-- Logout Icon (arrow out) -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
                                <path d="M7 4v16" />
                            </svg>
                            <span class="sidebar-label" data-label="Logout"></span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full flex items-center justify-center py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg transition duration-300">
                        <!-- Login Icon (arrow in) -->
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M15 12H3m0 0l4-4m-4 4l4 4" />
                            <path d="M21 4v16" />
                        </svg>
                        <span class="sidebar-label" data-label="Login"></span>
                    </a>
                @endif
            </div>
        </nav>
    </div>

    <div class="flex-1 p-4 md:p-8 bg-gray-50 min-h-screen h-screen flex flex-col overflow-auto max-w-full" id="main-content" style="margin-left: 4rem;">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 shadow-md">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>

<script>
    let sidebar = document.getElementById('sidebar');
    let hoverTimeout = null;
    let leaveTimeout = null;

    function expandSidebar() {
        clearTimeout(leaveTimeout);
        hoverTimeout = setTimeout(() => {
            sidebar.classList.remove('sidebar-collapsed');
            setTimeout(() => animateSidebarLabels(true), 120);
        }, 1000); // 0.25 detik delay
    }
    function collapseSidebar() {
        clearTimeout(hoverTimeout);
        leaveTimeout = setTimeout(() => {
            animateSidebarLabels(false);
            sidebar.classList.add('sidebar-collapsed');
        }, 50); // 0.25 detik delay
    }

    // Fungsi untuk split label jadi per-huruf span
    function splitSidebarLabels() {
        document.querySelectorAll('.sidebar-label').forEach(function(label) {
            const text = label.getAttribute('data-label');
            if (!text) return;
            let html = '';
            for (let i = 0; i < text.length; i++) {
                let delay = (i * 40) + 100; // ms
                html += `<span class="sidebar-letter" style="transition-delay:${delay}ms">${text[i] === ' ' ? '&nbsp;' : text[i]}</span>`;
            }
            label.innerHTML = html;
        });
    }

    // Fungsi untuk trigger animasi per-huruf
    function animateSidebarLabels(show) {
        document.querySelectorAll('.sidebar-label').forEach(function(label) {
            if (show) {
                label.classList.add('animated');
            } else {
                label.classList.remove('animated');
            }
        });
    }

    window.addEventListener('DOMContentLoaded', function() {
        splitSidebarLabels();
        collapseSidebar();
    });
</script>
</body>
</html>
