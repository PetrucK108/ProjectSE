<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - FutsalMatcher</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            font-family: 'Poppins', sans-serif;
        }

        .neon-outline {
            position: relative;
            z-index: 0;
        }

        .neon-outline::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 1rem;
            padding: 2px;
            background: conic-gradient(
                from 0deg,
                #06b6d4,
                #6366f1,
                #818cf8,
                #06b6d4 90%
            );
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            animation: neon-spin 50s linear infinite;
            z-index: 1;
        }

        @keyframes neon-spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .neon-outline> .card-content {
            position: relative;
            z-index: 2;
            border-radius: 1rem;
            background: #181829;
        }

        .btn-press {
            transition: transform 0.1s cubic-bezier(.4, 0, .2, 1), box-shadow 0.1s;
        }

        .btn-press:active {
            transform: scale(0.96);
            box-shadow: 0 2px 8px 0 #06b6d4;
        }

        .circle {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            border: 10px solid transparent;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .circle::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 10px solid;
            border-image: linear-gradient(to right, #06b6d4, #818cf8) 1;
            animation: rotate 6s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-950 to-blue-950 flex items-center justify-center min-h-screen text-white">
    <div class="relative flex flex-col items-center justify-center w-full min-h-screen">
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0">
            <div class="w-[540px] h-[540px] rounded-3xl bg-gradient-to-br from-blue-700/30 via-cyan-400/10 to-indigo-800/20 blur-2xl"></div>
        </div>
        <div class="neon-outline w-[480px] rounded-2xl shadow-2xl z-10">
            <div class="card-content p-12">
                <div class="flex flex-col items-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="FutsalMatcher Logo" class="w-24 h-24 mb-2 drop-shadow-xl">
                    <h2 class="text-4xl font-extrabold text-center text-[#e0e7ef] tracking-wide drop-shadow-lg mb-2">FutsalMatcher
                    </h2>
                    <span class="text-base text-cyan-300 font-semibold tracking-wider mb-2">Sign in to your account
                    </span>
                </div>
                @if(session('error'))
                <div class="mb-4 text-[#f87171] text-center">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-8">
                        <input type="email" name="email" placeholder="Gmail (example@gmail.com)" required
                            class="w-full px-0 py-3 bg-transparent border-b-2 border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition text-lg"
                            pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Masukkan Gmail yang valid" />
                    </div>
                    <div class="mb-4">
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full px-0 py-3 bg-transparent border-b-2 border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition text-lg" />
                    </div>
                    <div class="flex justify-between text-xs mb-10 mt-2">
                        {{-- <a href="#" class="text-[#64748b] hover:text-[#38bdf8] transition">Forgot Password?</a> --}}
                        <span></span>
                        <a href="{{ route('register') }}"
                            class="text-[#7dd3fc] hover:text-[#818cf8] font-semibold transition">Register</a>
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-cyan-400 to-blue-600 text-white font-semibold rounded-xl shadow btn-press transition text-xl hover:scale-105 hover:shadow-xl tracking-wide">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    // Disable browser back button
    if (window.history && window.history.pushState) {
        window.history.pushState('forward', null, window.location.href);
        window.onpopstate = function () {
            window.history.pushState('forward', null, window.location.href);
        };
    }
</script>

</html>
