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

<body class="bg-gray-900 flex items-center justify-center h-screen text-white">
    <div class="neon-outline w-[400px] rounded-xl shadow-2xl">
        <div class="card-content p-10">
            <h2 class="text-2xl font-bold mb-8 text-center text-[#e0e7ef] tracking-wide">Sign in</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required
                    class="w-full mb-6 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition" />
                <input type="password" name="password" placeholder="Password" required
                    class="w-full mb-2 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition" />

                <div class="flex justify-between text-xs mb-8 mt-2">
                    <a href="#" class="text-[#64748b] hover:text-[#38bdf8] transition">Forgot Password?</a>
                    <a href="{{ route('register') }}" class="text-[#7dd3fc] hover:text-[#818cf8] font-semibold transition">Signup</a>
                </div>

                <button type="submit"
                    class="w-full py-2 bg-white text-[#181829] font-semibold rounded shadow btn-press transition">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
