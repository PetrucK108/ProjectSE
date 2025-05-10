<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - FutsalMatcher</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
            border-image: linear-gradient(to right, #00ffff, #007fff) 1;
            animation: rotate 6s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen text-white">
    <div class="absolute top-8 text-center w-full">
        <h1 class="text-4xl font-bold text-cyan-400">FutsalMatcher</h1>
    </div>

    <div class="circle"></div>

    <div class="absolute w-full max-w-sm p-8 bg-gray-800 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-cyan-400">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full mb-4 px-4 py-2 rounded bg-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-400" />
            <input type="text" name="phone" placeholder="No Telepon" required class="w-full mb-4 px-4 py-2 rounded bg-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-400" />
            <input type="email" name="email" placeholder="Email" required class="w-full mb-4 px-4 py-2 rounded bg-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-400" />
            <input type="password" name="password" placeholder="Password" required class="w-full mb-4 px-4 py-2 rounded bg-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-400" />

            <button type="submit" class="w-full py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded">Signup</button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-cyan-300 hover:underline">Sudah punya akun? Login</a>
        </div>
    </div>
</body>
</html>
