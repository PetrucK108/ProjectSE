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

        select[name="fakultas"] {
            color: #e0e7ef;
            background: transparent;
        }

        select[name="fakultas"]:focus {
            color: #e0e7ef;
        }

        select[name="fakultas"] option {
            color: #181829;
            background: #fff;
        }

        select[name="fakultas"] option:checked,
        select[name="fakultas"]:focus>option:checked {
            color: #e0e7ef;
            background: #334155;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-950 to-blue-950 flex items-center justify-center min-h-screen text-white">
    <div class="relative flex flex-col items-center justify-center w-full min-h-screen">
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0">
            <div class="w-[480px] h-[480px] rounded-3xl bg-gradient-to-br from-blue-700/30 via-cyan-400/10 to-indigo-800/20 blur-2xl"></div>
        </div>
        <div class="neon-outline w-[420px] rounded-xl shadow-2xl z-10">
            <div class="card-content p-10">
                <h2 class="text-3xl font-extrabold mb-8 text-center text-[#e0e7ef] tracking-wide drop-shadow-lg">Register
                </h2>
                <form method="POST" action="{{ route('register.submit') }}">
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
                        class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition text-base" />
                    <input type="text" name="phone" placeholder="No Telepon" required
                        class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition text-base" />
                    <input type="email" name="email" placeholder="Gmail (example@gmail.com)" required
                        class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition text-base"
                        pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Masukkan Gmail yang valid" />
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8] placeholder:text-[#64748b] transition text-base" />

                    <div class="mb-6">
                        <label for="fakultas" class="block text-[#e0e7ef] mb-1 font-semibold">Fakultas</label>
                        <select id="fakultas" name="fakultas" required
                            class="w-full mb-4 px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8]">
                            <option value="" disabled selected style="color:#64748b;background:#f1f5f9;">Pilih Fakultas
                            </option>
                            <option value="Binus Business School">🎓 Binus Business School (Soshum)</option>
                            <option value="Faculty of Economics and Communication">📊 Faculty of Economics and Communication
                                (Soshum & D3)
                            </option>
                            <option value="Faculty of Engineering">🛠 Faculty of Engineering (Saintek)</option>
                            <option value="Faculty of Humanities">🏛 Faculty of Humanities</option>
                            <option value="School of Computer Science">💻 School of Computer Science (Saintek)</option>
                            <option value="School of Design">🎨 School of Design</option>
                            <option value="School of Information Systems">🖥 School of Information Systems</option>
                        </select>
                        <label for="jurusan" class="block text-[#e0e7ef] mb-1 font-semibold">Jurusan</label>
                        <select id="jurusan" name="jurusan" required
                            class="w-full px-0 py-2 bg-transparent border-b border-[#334155] text-[#e0e7ef] focus:outline-none focus:border-[#38bdf8]">
                            <option value="" disabled selected>Pilih Jurusan</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full py-2 bg-gradient-to-r from-cyan-400 to-blue-600 text-white font-semibold rounded shadow btn-press transition text-lg hover:scale-105 hover:shadow-xl">
                        Signup
                    </button>
                </form>
                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-[#7dd3fc] hover:text-[#818cf8] hover:underline transition">Sudah
                        punya akun? Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const jurusanMap = {
        "Binus Business School": [
            "Management",
            "Global Business Marketing",
            "International Business Management"
        ],
        "Faculty of Economics and Communication": [
            "Tourism",
            "Accounting",
            "Marketing Communication",
            "Mass Communication",
            "Taxation",
            "Business Hotel Management (Diploma)",
            "Hotel Management (Diploma)"
        ],
        "Faculty of Engineering": [
            "Civil Engineering",
            "Industrial Engineering",
            "Architecture",
            "Computer Engineering"
        ],
        "Faculty of Humanities": [
            "Chinese Literature",
            "English Literature",
            "International Relations",
            "Japanese Literature",
            "Law – Business Law",
            "Primary Teacher Education",
            "Psychology"
        ],
        "School of Computer Science": [
            "Computer Science",
            "Computer Science – Software Engineering",
            "Cyber Security",
            "Data Science",
            "Game Application and Technology",
            "Mobile Application and Technology"
        ],
        "School of Design": [
            "Visual Communication Design – Animation",
            "Visual Communication Design – New Media",
            "Visual Communication Design – Creative Advertising",
            "Interior Design"
        ],
        "School of Information Systems": [
            "Information Systems",
            "Business Analytics",
            "Business Information Technology",
            "Information Systems Accounting and Auditing"
        ]
    };

    document.addEventListener('DOMContentLoaded', function () {
        const fakultasSelect = document.getElementById('fakultas');
        const jurusanSelect = document.getElementById('jurusan');

        fakultasSelect.addEventListener('change', function () {
            const selectedFakultas = this.value;
            jurusanSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan</option>';
            if (jurusanMap[selectedFakultas]) {
                jurusanMap[selectedFakultas].forEach(jurusan => {
                    const opt = document.createElement('option');
                    opt.value = jurusan;
                    opt.textContent = jurusan;
                    jurusanSelect.appendChild(opt);
                });
            }
        });
    });

    // Disable browser back button
    if (window.history && window.history.pushState) {
        window.history.pushState('forward', null, window.location.href);
        window.onpopstate = function () {
            window.history.pushState('forward', null, window.location.href);
        };
    }
</script>

</html>
