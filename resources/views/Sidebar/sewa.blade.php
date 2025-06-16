@extends('Sidebar.sidebar')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .field-card {
            background: linear-gradient(135deg, #f8fafc 60%, #e0e7ef 100%);
            border-radius: 2rem;
            box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.13);
            transition: transform 0.25s cubic-bezier(.4, 0, .2, 1), box-shadow 0.25s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 2.5px solid #e0e7ef;
            min-height: 520px;
            min-width: 320px;
            max-width: 420px;
            width: 100%;
            position: relative;
            margin: 0 auto;
        }

        .field-card:hover {
            transform: translateY(-10px) scale(1.04);
            box-shadow: 0 20px 48px 0 rgba(31, 38, 135, 0.18);
            border-color: #38bdf8;
        }

        .field-img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-radius: 2rem 2rem 0 0;
            box-shadow: 0 4px 24px 0 rgba(99, 102, 241, 0.10);
            margin-bottom: 1.5rem;
        }

        .field-title {
            font-size: 1.6rem;
            font-weight: 900;
            color: #23234a;
            margin-bottom: 0.3rem;
            letter-spacing: 0.01em;
            text-shadow: 0 2px 8px #e0e7ef80;
        }

        .field-meta {
            font-size: 1.1rem;
            color: #6366f1;
            font-weight: 700;
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .field-price {
            font-size: 1.2rem;
            color: #0ea5e9;
            font-weight: 800;
            margin-bottom: 0.3rem;
        }

        .field-capacity {
            font-size: 1.05rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 0.7rem;
        }

        .field-actions {
            display: flex;
            gap: 0.7rem;
            width: 100%;
            margin-top: 1.5rem;
            justify-content: center;
        }

        .field-btn {
            flex: 1 1 0;
            padding: 0.7rem 0;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 1.15rem;
            transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px 0 rgba(99, 102, 241, 0.07);
            border: none;
            outline: none;
            cursor: pointer;
            text-align: center;
        }

        .btn-location {
            background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
            color: #fff;
        }

        .btn-location:hover {
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            transform: scale(1.07);
            box-shadow: 0 4px 16px 0 #6366f1;
        }

        .btn-book {
            background: linear-gradient(90deg, #23234a 0%, #181829 100%);
            color: #fff;
        }

        .btn-book:hover {
            background: linear-gradient(90deg, #181829 0%, #23234a 100%);
            transform: scale(1.07);
            box-shadow: 0 4px 16px 0 #23234a;
        }

        .field-badge {
            position: absolute;
            top: 1.1rem;
            right: 1.1rem;
            background: linear-gradient(90deg, #38bdf8 0%, #6366f1 100%);
            color: #fff;
            font-size: 1.05rem;
            font-weight: 700;
            border-radius: 9999px;
            padding: 0.4rem 1.3rem;
            letter-spacing: 0.04em;
            z-index: 2;
            box-shadow: 0 2px 8px 0 rgba(99, 102, 241, 0.13);
            border: 2px solid #fff;
            text-shadow: 0 2px 8px #23234a30;
        }

        /* Responsive grid: 4 per row, wrap to next row */
        .fields-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2.5rem;
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        @media (max-width: 1600px) {
            .fields-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 1200px) {
            .fields-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .fields-grid {
                grid-template-columns: 1fr;
            }

            .field-card {
                min-width: 0;
                max-width: 100%;
            }
        }
    </style>

    <div class="max-w-7xl mx-auto py-8 px-4 flex flex-col items-center">
        <div class="flex flex-col items-center mb-8">
            <div
                class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-indigo-500 to-purple-600 mb-2 tracking-tight drop-shadow-lg">
                <i class="inline-block align-middle" style="vertical-align:-0.2em;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-10 h-10 mb-2 text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="14" rx="3" stroke="currentColor"
                            stroke-width="2" fill="none" />
                        <path d="M3 9h18M7 5v-2M17 5v-2" stroke="currentColor" stroke-width="2" fill="none" />
                    </svg>
                </i>
                Field Booking
            </div>
            <div class="text-lg text-gray-500 font-medium mb-2 text-center">Find and book your favorite futsal field easily!
            </div>
        </div>

        <!-- Kalkulator Split Biaya Sewa (lebar penuh grid, horizontal layout, tinggi lebih kecil) -->
        <div class="w-full mb-10 flex justify-center">
            <div class="bg-white rounded-2xl shadow-xl px-8 py-4 flex flex-col items-center"
                style="width:100%;max-width:100%;min-width:0;">
                <div class="text-2xl font-extrabold text-blue-700 mb-2 flex items-center gap-2">
                    <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="4" stroke="currentColor"
                            stroke-width="2" fill="none" />
                        <path d="M8 7h8M8 11h8M8 15h4" stroke="currentColor" stroke-width="2" fill="none" />
                    </svg>
                    Kalkulator Split Biaya Sewa
                </div>
                <div class="text-gray-600 mb-3 text-center">Hitung otomatis berapa biaya yang harus dibayar tiap orang untuk
                    sewa lapangan futsal!</div>
                <form id="splitForm" class="w-full flex flex-col items-center gap-1">
                    <!-- Baris 1: Label -->
                    <div class="flex flex-row w-full gap-6 mb-1 justify-center">
                        <label class="block text-gray-700 font-semibold text-center w-64">Total Biaya Sewa (Rp)</label>
                        <label class="block text-gray-700 font-semibold text-center w-64">Jumlah Orang</label>
                        <label class="block text-gray-700 font-semibold text-center w-64">Hasil per Orang</label>
                    </div>
                    <!-- Baris 2: Input -->
                    <div class="flex flex-row w-full gap-6 mb-1 justify-center">
                        <input type="text" id="totalBiaya" class="w-64 border rounded px-3 py-2 text-lg text-center"
                            min="0" placeholder="Contoh: 250.000" required autocomplete="off">
                        <input type="number" id="jumlahOrang" class="w-64 border rounded px-3 py-2 text-lg text-center"
                            min="1" placeholder="Contoh: 10" required>
                        <div id="splitResult"
                            class="w-64 text-lg font-semibold flex items-center justify-center min-h-[44px]"></div>
                    </div>
                    <!-- Baris 3: Button -->
                    <div class="flex flex-row w-full gap-6 mt-1 justify-center">
                        <button type="submit"
                            class="w-64 px-6 py-2 rounded-xl bg-gradient-to-r from-cyan-400 to-blue-600 text-white font-bold shadow hover:scale-105 transition">Hitung</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Centered grid: agar fields-grid benar-benar rata tengah dengan Field Booking -->
        <div class="w-full flex justify-center">
            <div class="fields-grid" style="margin-left:auto;margin-right:auto;">
                @php
                    $lapangan = \App\Data\LapanganData::all();
                @endphp

                @foreach ($lapangan as $l)
                    <div class="field-card group relative">
                        <img src="{{ $l['gambar'] }}" alt="{{ $l['nama'] }}" class="field-img">
                        <div class="w-full flex flex-col items-center px-2">
                            <h2 class="field-title mb-1">{{ $l['nama'] }}</h2>
                            <div class="field-meta mb-1">
                                {{-- ...existing code... --}}
                                {{ $l['lokasi'] }}
                            </div>
                            <div class="field-price mb-1">
                                {{-- ...existing code... --}}
                                {{ $l['harga'] }}
                            </div>
                            <div class="field-actions mt-3 w-full flex-col flex items-center gap-2">
                                @php
                                    // Perbaiki link Google Maps jika kosong atau short url
                                    $nama = urlencode($l['nama'] . ' futsal');
                                    $lokasi = isset($l['lokasi']) ? urlencode($l['lokasi']) : '';
                                    $mapsUrl = $l['link'];
                                    if (empty($mapsUrl) || str_contains($mapsUrl, 'goo.gl/maps/')) {
                                        $mapsUrl = "https://www.google.com/maps/search/?api=1&query={$nama}%20{$lokasi}";
                                    }
                                @endphp
                                <a href="{{ $mapsUrl }}" target="_blank"
                                    class="field-btn btn-location flex items-center justify-center gap-2 w-14 h-14 p-0 rounded-full">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                        <circle cx="12" cy="9" r="2.5" />
                                    </svg>
                                </a>
                                <div class="mt-2 text-lg text-blue-700 font-bold tracking-wide">Contact</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Kalkulator Split Biaya Sewa
            const splitForm = document.getElementById('splitForm');
            const totalBiayaInput = document.getElementById('totalBiaya');
            const splitResult = document.getElementById('splitResult');
            if (totalBiayaInput) {
                totalBiayaInput.addEventListener('input', function(e) {
                    // Format input dengan titik ribuan
                    let val = this.value.replace(/\D/g, '');
                    if (val) {
                        this.value = parseInt(val, 10).toLocaleString('id-ID');
                    } else {
                        this.value = '';
                    }
                });
            }
            if (splitForm) {
                splitForm.onsubmit = function(e) {
                    e.preventDefault();
                    let totalStr = totalBiayaInput.value.replace(/\./g, '').replace(/,/g, '');
                    const total = parseInt(totalStr, 10);
                    const orang = parseInt(document.getElementById('jumlahOrang').value, 10);
                    if (isNaN(total) || isNaN(orang) || orang < 1) {
                        splitResult.textContent = "Masukkan jumlah biaya dan orang yang valid!";
                        splitResult.className =
                            "w-64 text-lg font-semibold flex items-center justify-center min-h-[44px] text-red-500";
                        return;
                    }
                    const perOrang = Math.ceil(total / orang / 100) * 100; // dibulatkan ke atas per 100
                    splitResult.textContent = "Rp " + perOrang.toLocaleString('id-ID');
                    splitResult.className =
                        "w-64 text-lg font-semibold flex items-center justify-center min-h-[44px] text-green-600";
                };
            }
        });
    </script>
@endsection
