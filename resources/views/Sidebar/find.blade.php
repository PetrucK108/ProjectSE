@extends('Sidebar.sidebar')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 py-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Find Saya (Dummy Mode)</h1>

        @php
            $dummyTeams = [
                (object)[
                    'id' => 1,
                    'name' => 'Teknik Futsal',
                    'foto_tim' => 'images/Teknik.png',
                    'member_count' => 5,
                    'skill_level' => 'Intermediate',
                    'gaya_bermain' => 'Posesif',
                    'avg_gol' => 2.3,
                    'avgConceded' => 1.2
                ],
                (object)[
                    'id' => 2,
                    'name' => 'Komunikasi Gacor',
                    'foto_tim' => 'images/Viscom.png',
                    'member_count' => 6,
                    'skill_level' => 'Beginner',
                    'gaya_bermain' => 'Counter Attack',
                    'avg_gol' => 1.1,
                    'avgConceded' => 3.4
                ],
                (object)[
                    'id' => 3,
                    'name' => 'Macan Selatan',
                    'foto_tim' => 'images/Mene.png',
                    'member_count' => 7,
                    'skill_level' => 'Advanced',
                    'gaya_bermain' => 'Tiki Taka',
                    'avg_gol' => 4.0,
                    'avgConceded' => 0.9
                ],
            ];

            $index = request()->query('index', 0);
            $teamToShow = $dummyTeams[$index] ?? null;
        @endphp

        @if ($teamToShow)
            <div class="w-[90vw] max-w-sm bg-white rounded-xl shadow-lg flex flex-col overflow-hidden">
                <!-- Gambar -->
                <div class="w-full h-[140px] overflow-hidden">
                    <img src="{{ asset($teamToShow->foto_tim ?? 'images/lapangan.png') }}"
                        alt="Foto Tim"
                        class="w-full h-full object-cover object-center rounded-t-xl" />
                </div>

                <!-- Detail Tim -->
                <div class="flex-1 px-4 py-3 text-sm text-gray-800">
                    <div class="flex items-center gap-2 mb-1">
                        <h2 class="text-lg font-semibold">{{ $teamToShow->name }}</h2>
                        <span class="text-blue-500" title="Verified">
                            <svg class="inline w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" />
                            </svg>
                        </span>
                    </div>

                    <div class="flex gap-3 text-gray-600 text-xs mb-2">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 10a3 3 0 116 0 3 3 0 01-6 0z" />
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3 7-8 7s-8-3.134-8-7a8 8 0 1116 0zm-8 5a5 5 0 100-10 5 5 0 000 10z" clip-rule="evenodd" />
                            </svg>
                            {{ $teamToShow->member_count }} pemain
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 16v-4m0-4h.01" />
                            </svg>
                            Belum ada rating
                        </div>
                    </div>

                    <div class="space-y-0.5 text-sm text-gray-700">
                        <p><strong>Skill:</strong> {{ $teamToShow->skill_level }}</p>
                        <p><strong>Style:</strong> {{ $teamToShow->gaya_bermain }}</p>
                        <p><strong>Gol:</strong> {{ $teamToShow->avg_gol }}</p>
                        <p><strong>Kebobolan:</strong> {{ $teamToShow->avgConceded }}</p>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between items-center px-5 py-3 bg-gray-100">
                    <a href="?index={{ $index + 1 }}"
                        class="rounded-full bg-white border-2 border-red-400 w-12 h-12 flex items-center justify-center text-red-500 shadow hover:bg-red-50 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>

                    <a href="?index={{ $index + 1 }}"
                        class="rounded-full bg-white border-2 border-green-400 w-12 h-12 flex items-center justify-center text-green-500 shadow hover:bg-green-50 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </a>
                </div>
            </div>
        @else
            <p class="text-gray-500 mt-10">Semua tim sudah ditampilkan.</p>
        @endif
    </div>
@endsection
