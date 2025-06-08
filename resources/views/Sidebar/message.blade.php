@extends('Sidebar.sidebar')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    .msg-scrollbar::-webkit-scrollbar {
        width: 6px;
        background: transparent;
    }

    .msg-scrollbar::-webkit-scrollbar-thumb {
        background: #ffffff;
        border-radius: 3px;
    }

    .fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@php
    $chatTeams = [
        [
            'name' => 'Komunikasi Gacor',
            'image' => asset('images/Viscom.png'),
            'last_message' => 'Siap bro, lanjut!',
        ]
    ];

    $activeChat = [
        'name' => 'Komunikasi Gacor',
        'messages' => [
            ['from' => 'me', 'text' => 'Brok, Jadi Ga Nih Sparring', 'time' => '14:01'],
            ['from' => 'them', 'text' => 'Gass', 'time' => '14:03'],
            ['from' => 'me', 'text' => 'Siap bro, lanjut Cari Lapangan Yakk!', 'time' => '14:04'],
        ]
    ];
@endphp

<div class="flex h-screen w-full overflow-hidden bg-[#0f172a] rounded-2xl shadow-lg">

    <!-- Sidebar -->
    <div class="w-80 bg-slate-700 text-white">

        <!-- Header Sidebar -->
        <div class="bg-slate-700 px-6 py-4 text-lg font-semibold rounded-br-3xl border-b border-white/10">
            Pesan Tim
        </div>

        <div class="flex-1 overflow-y-auto msg-scrollbar px-3 py-4 space-y-3">
            @foreach ($chatTeams as $team)
                <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-slate-700 hover:bg-[#0f172a] transition duration-200 cursor-pointer shadow-sm border border-white/10">
                    <img src="{{ $team['image'] }}" class="w-10 h-10 rounded-full object-cover" alt="{{ $team['name'] }}">
                    <div class="flex-1 min-w-0">
                        <span class="font-semibold text-white">{{ $team['name'] }}</span>
                        <div class="text-sm truncate text-white opacity-60">{{ $team['last_message'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Chat Area -->
    <div class="flex-1 flex flex-col text-white">

        <!-- Header Chat -->
        <div class="px-6 py-4 bg-slate-700 border-b border-white/10">
            <span class="text-sm text-white opacity-70">
                Chat With <strong>{{ $activeChat['name'] }}</strong>
            </span>
        </div>

        <!-- Body Chat -->
        <div class="flex-1 overflow-y-auto px-6 py-6 flex flex-col gap-6 msg-scrollbar bg-[#0f172a]">
            @foreach ($activeChat['messages'] as $message)
                @if ($message['from'] === 'me')
                    <div class="flex justify-end fade-in">
                        <div class="max-w-[70%]">
                            <div class="bg-slate-700 px-5 py-3 rounded-2xl rounded-br-sm shadow">
                                {{ $message['text'] }}
                            </div>
                            <div class="text-xs text-right opacity-60 mt-1">{{ $message['time'] }}</div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-start fade-in">
                        <div class="max-w-[70%]">
                            <div class="bg-slate-700 px-5 py-3 rounded-2xl rounded-bl-sm shadow">
                                {{ $message['text'] }}
                            </div>
                            <div class="text-xs text-left opacity-60 mt-1">{{ $message['time'] }}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Input Chat -->
        <form class="flex items-center gap-3 px-6 py-4 bg-slate-700 border-t border-white/10">
            <input
                type="text"
                class="flex-1 bg-[#0f172a] border border-white/10 rounded-xl text-white px-4 py-2 focus:ring-2 focus:ring-white outline-none transition-all"
                placeholder="Ketik pesan..."
                disabled
            />
            <button
                type="button"
                disabled
                class="ml-2 px-6 py-2 rounded-full bg-[#0f172a] text-white font-semibold shadow opacity-50 cursor-not-allowed"
            >
                KIRIM
            </button>
        </form>
    </div>
</div>
@endsection
