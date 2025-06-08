@extends('Sidebar.sidebar')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .transition-base {
            @apply transition duration-300 ease-in-out;
        }
    </style>

    <div class="p-6 space-y-8">

        {{-- NEXT MATCH --}}
        <div
            class="flex flex-col md:flex-row justify-between gap-4 bg-gray-50 rounded-xl shadow-md p-6 border-l-4 border-gray-800 transition-base">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                    <i data-lucide="calendar" class="w-5 h-5 text-gray-800"></i> Next Match
                </h3>
                <p><strong>Lapangan:</strong> Lapangan Futsal ABC</p>
                <p><strong>Hari:</strong> Minggu</p>
                <p><strong>Tanggal:</strong> 19 Mei 2025</p>
                <p><strong>Jam:</strong> 20:30 WIB</p>
            </div>
            <div
                class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center justify-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 cursor-pointer">
                <div class="text-sm text-gray-500 mb-1">Total Matches</div>
                <div class="text-3xl font-bold text-gray-800">25</div>
            </div>

        </div>


        {{-- STATISTICS --}}
        @php
            $cards = [
                [
                    ['label' => 'Squad Size', 'value' => $squadSize],
                    ['label' => 'Avg Age', 'value' => number_format($avgAge, 1)],
                ],
                [
                    [
                        'label' => 'Profil Tim',
                        'value' => Auth::user()->skill_level ?? 'N/A',
                        'extra' => Auth::user()->gaya_bermain ?? 'N/A',
                    ],
                    ['label' => 'Avg Goals', 'value' => number_format($avg_gol, 2)],
                ],
                [
                    ['label' => 'Total Kebobolan', 'value' => $totalConceded],
                    ['label' => 'Avg Kebobolan', 'value' => number_format($avgConceded, 2)],
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($cards as $column)
                <div class="flex flex-col gap-6">
                    @foreach ($column as $card)
                        <div
                            class="bg-white p-4 rounded-lg shadow text-center 
                flex flex-col justify-center items-center h-32 
                transition transform duration-300 ease-in-out 
                hover:scale-105 hover:shadow-lg">
                            <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $card['value'] }}</p>
                            @if (isset($card['extra']))
                                <p class="text-sm text-gray-600 mt-1">{{ $card['extra'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- PROFIL TIM UNTUK REKOMENDASI --}}
        <div class="bg-gray-50 rounded-xl shadow-md p-6 border-l-4 border-gray-800 transition-base">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i data-lucide="settings" class="w-5 h-5 text-gray-800"></i> Profil Tim untuk Rekomendasi
            </h3>

            <form method="POST" action="{{ route('profil.tim.update') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-600 mb-1">Skill Level</label>
                    <select name="skill_level" class="w-full border rounded-md px-3 py-2">
                        <option value="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Advanced</option>
                        <option value="4">Professional</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Gaya Bermain</label>
                    <select name="gaya_bermain" class="w-full border rounded-md px-3 py-2">
                        <option value="1">Ultra Defensive</option>
                        <option value="2">Defensive</option>
                        <option value="3">Balanced</option>
                        <option value="4">Attacking</option>
                        <option value="5">Ultra Attacking</option>
                    </select>
                </div>

                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                    Simpan Profil Tim
                </button>
            </form>
        </div>


        <div class="bg-gray-50 rounded-xl shadow-md p-6 border-l-4 border-gray-800 transition-base">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i data-lucide="plus-circle" class="w-5 h-5 text-gray-800"></i> Tambah Pemain
            </h3>
            <form action="{{ route('profil.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-gray-600 mb-1">Nama</label>
                    <input name="nama" type="text" class="w-full border rounded-md px-3 py-2"
                        placeholder="Masukkan nama" required>
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Nomor Punggung</label>
                    <input type="number" name="nomor" required min="0"
                        class="w-full border p-2 rounded-lg shadow-sm" required>
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Umur</label>
                    <input type="number" name="umur" required min="18"
                        class="w-full border p-2 rounded-lg shadow-sm" required>
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Jurusan</label>
                    <input name="jurusan" type="text" class="w-full border rounded-md px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Angkatan (B..)</label>
                    <input name="angkatan" type="text" class="w-full border rounded-md px-3 py-2"
                        placeholder="Contoh: B27" required>
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Posisi</label>
                    <select name="posisi" class="w-full border rounded-md px-3 py-2 text-gray-600" required>
                        <option value="" disabled selected hidden>Pilih Posisi</option>
                        <option value="Kiper">Kiper</option>
                        <option value="Anchor">Anchor</option>
                        <option value="Pivot">Pivot</option>
                        <option value="Flank">Flank</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <button type="submit"
                        class="mt-2 w-full bg-gray-800 text-white py-2 rounded-md 
           transition transform duration-200 ease-in-out 
           hover:scale-105 hover:bg-gray-700 
           active:scale-95">
                        <i data-lucide="user-plus" class="inline w-5 h-5 mr-2"></i> Tambahkan
                    </button>
                </div>
            </form>
        </div>

        {{-- SQUAD --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i data-lucide="users" class="w-5 h-5 text-gray-800"></i> Squad
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden transition-base">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left px-4 py-2">Nama</th>
                            <th class="text-left px-4 py-2">Posisi</th>
                            <th class="text-left px-4 py-2">Nomor</th>
                            <th class="text-left px-4 py-2">Jurusan</th>
                            <th class="text-left px-4 py-2">B.</th>
                            <th class="text-left px-4 py-2">Gol</th>
                            <th class="text-left px-4 py-2">Assist</th>
                            <th class="text-left px-4 py-2">Kebobolan</th>
                            <th class="text-left px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y">
                        @foreach ($players as $p)
                            <tr>
                                <td class="px-4 py-2">{{ $p->nama }}</td>
                                <td class="px-4 py-2">{{ $p->posisi }}</td>
                                <td class="px-4 py-2">{{ $p->nomor }}</td>
                                <td class="px-4 py-2">{{ $p->jurusan }}</td>
                                <td class="px-4 py-2">{{ $p->angkatan }}</td>
                                <td class="px-4 py-2">{{ $p->gol }}</td>
                                <td class="px-4 py-2">{{ $p->assist }}</td>
                                <td class="px-4 py-2">{{ $p->goals_conceded }}</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('profil.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pemain ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-gray-800 hover:bg-gray-800 text-white px-3 py-1 rounded-lg text-sm shadow transition duration-200">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- EDIT PROFIL TIM --}}
        <div class="bg-gray-50 rounded-xl shadow-md p-6 border-l-4 border-gray-800 transition-base">
            <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2 mb-4">
                <i data-lucide="edit" class="w-5 h-5 text-gray-800"></i> Edit Profil Tim
            </h3>
            
            <form method="POST" action="{{ route('profil.tim.edit') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-gray-600 mb-1">Nama Tim</label>
                    <input name="nama_tim" type="text" value="{{ Auth::user()->name }}" 
                        class="w-full border rounded-md px-3 py-2" placeholder="Masukkan nama tim" required>
                </div>
                
                <div>
                    <label class="block text-gray-600 mb-1">Password</label>
                    <input name="password" type="password" 
                        class="w-full border rounded-md px-3 py-2" placeholder="Password baru (kosongkan jika tidak ingin mengubah)">
                </div>
                
                <div>
                    <label class="block text-gray-600 mb-1">Email Tim</label>
                    <input name="email" type="email" value="{{ Auth::user()->email }}" 
                        class="w-full border rounded-md px-3 py-2" placeholder="Email tim" required>
                </div>
                
                <div>
                    <label class="block text-gray-600 mb-1">No Telepon</label>
                    <input name="phone" type="text" value="{{ Auth::user()->phone }}" 
                        class="w-full border rounded-md px-3 py-2" placeholder="Nomor telepon tim">
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">Foto Profil Tim</label>
                    <input type="file" name="foto_profil" accept="image/*" class="w-full border rounded-md px-3 py-2">
                </div>
                
                <div class="md:col-span-2 flex items-center gap-4">
                    <button type="submit"
                        class="bg-gray-800 text-white px-6 py-2 rounded-md 
                        transition transform duration-200 ease-in-out 
                        hover:scale-105 hover:bg-gray-700 
                        active:scale-95">
                        <i data-lucide="save" class="inline w-4 h-4 mr-2"></i> Simpan Perubahan
                    </button>
                    
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                            <i data-lucide="camera" class="w-5 h-5 text-gray-500"></i>
                        </div>
                        <span>Ganti Foto Profil Tim</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection