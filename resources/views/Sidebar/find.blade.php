@extends('Sidebar.sidebar')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[80vh]">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Find Saya</h1>

        @if ($teamToShow)
            <div class="relative bg-white rounded-2xl shadow-xl w-[400px] max-w-full overflow-hidden">
                <!-- Team Photo -->
                <div class="h-[400px] w-full bg-gray-200 flex items-center justify-center overflow-hidden">
                    <img src="{{ $teamToShow->foto_tim ?? asset('images/lapangan.png') }}" alt="Team Photo"
                        class="object-cover w-full h-full" />
                </div>
                <!-- Team Info -->
                <div class="p-6 pb-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-2xl font-bold text-gray-900">{{ $teamToShow->name }}</span>
                        <span class="text-blue-500" title="Verified">
                            <svg class="inline w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" />
                            </svg>
                        </span>
                    </div>
                    <div class="flex items-center gap-3 text-base text-gray-500 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 10a3 3 0 116 0 3 3 0 01-6 0z" />
                                <path fill-rule="evenodd"
                                    d="M18 10c0 3.866-3.582 7-8 7s-8-3.134-8-7a8 8 0 1116 0zm-8 5a5 5 0 100-10 5 5 0 000 10z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $teamToShow->member_count ?? 2 }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 16v-4m0-4h.01" />
                            </svg>
                            0
                        </span>
                    </div>
                    <div class="text-gray-700 text-base mb-2 leading-relaxed">
                        <span class="font-semibold">Skill Level:</span> {{ $teamToShow->skill_level }}<br>
                        <span class="font-semibold">Play Style:</span> {{ $teamToShow->gaya_bermain }}<br>
                        <span class="font-semibold">Rata-rata Gol:</span> {{ $teamToShow->avg_gol }}<br>
                        <span class="font-semibold">Rata-rata Kebobolan:</span> {{ $teamToShow->avgConceded }}
                    </div>
                </div>
                <!-- Swipe Buttons -->
                <div class="flex justify-between items-center px-10 py-6 bg-gray-50 border-t">
                    <button type="button"
                        class="rounded-full bg-white border-2 border-yellow-400 w-14 h-14 flex items-center justify-center text-yellow-400 text-2xl shadow hover:bg-yellow-50 transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M2 12h20" />
                        </svg>
                    </button>
                    <form method="POST" action="{{ route('swipe.action') }}" class="inline">
                        @csrf
                        <input type="hidden" name="target_user_id" value="{{ $teamToShow->id }}">
                        <button type="submit" name="action" value="decline"
                            class="rounded-full bg-white border-2 border-red-400 w-20 h-20 flex items-center justify-center text-red-500 text-3xl shadow hover:bg-red-50 transition">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                    <form method="POST" action="{{ route('swipe.action') }}" class="inline">
                        @csrf
                        <input type="hidden" name="target_user_id" value="{{ $teamToShow->id }}">
                        <button type="submit" name="action" value="accept"
                            class="rounded-full bg-white border-2 border-green-400 w-20 h-20 flex items-center justify-center text-green-500 text-3xl shadow hover:bg-green-50 transition">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                    </form>
                    <button type="button"
                        class="rounded-full bg-white border-2 border-blue-400 w-14 h-14 flex items-center justify-center text-blue-400 text-2xl shadow hover:bg-blue-50 transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>
        @else
            <p class="text-gray-500 mt-10">Tidak ada rekomendasi tim yang cocok saat ini.</p>
        @endif
    </div>
@endsection
