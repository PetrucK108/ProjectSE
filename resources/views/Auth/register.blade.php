<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - FutsalMatcher</title>
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

        select[name="jurusan"] {
            color: #e0e7ef;
            background: transparent;
        }

        select[name="jurusan"]:focus {
            color: #e0e7ef;
        }

        select[name="jurusan"] option {
            color: #181829;
            background: #fff;
        }

        select[name="jurusan"] option:checked,
        select[name="jurusan"]:focus>option:checked {
            color: #e0e7ef;
            background: #334155;
        }
    </style>
</head>

<body class="bg-gray-900 flex items-center justify-center h-screen text-white">
    <div class="neon-outline w-[420px] rounded-xl shadow-2xl">
        <div class="card-content p-10">
            <h2 class="text-2xl font-bold mb-8 text-center text-[#e0e7ef] tracking-wide">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                @if ($errors->any())
                <div class="mb-4 text-[#f87171]">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <input type="text" name="name" placeholder="Nama Lengkap" required
                    class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition" />
                <input type="text" name="phone" placeholder="No Telepon" required
                    class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition" />
                <input type="email" name="email" placeholder="Email" required
                    class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition" />
                <input type="password" name="password" placeholder="Password" required
                    class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition" />

                <select name="jurusan" required
                    class="w-full mb-6 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8]">
                    <option value="" disabled selected class="text-gray-400">Pilih Jurusan</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Teknik Elektro">Teknik Elektro</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                    <option value="Teknik Sipil">Teknik Sipil</option>
                </select>

                <button type="submit"
                    class="w-full py-2 bg-white text-[#181829] font-semibold rounded shadow btn-press transition">Signup</button>
            </form>
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-[#7dd3fc] hover:text-[#818cf8] hover:underline transition">Sudah punya akun? Login</a>
            </div>
        </div>
    </div>
</body>

</html>
