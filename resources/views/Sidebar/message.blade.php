@extends('Sidebar.sidebar')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    .msg-gradient-header {
        background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
    }

    .msg-scrollbar::-webkit-scrollbar {
        width: 6px;
        background: #1e293b;
    }

    .msg-scrollbar::-webkit-scrollbar-thumb {
        background: #0ea5e9;
        border-radius: 3px;
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

<div class="flex h-screen w-full overflow-hidden bg-gray-900 rounded-2xl shadow-lg">

    {{-- Sidebar Chat List --}}
    <div class="w-80 bg-gray-800 text-white flex flex-col">

        {{-- Header --}}
        <div class="msg-gradient-header px-6 py-5 flex items-center gap-3">
            <span class="text-white font-semibold text-lg flex-1">Pesan Tim</span>
        </div>

        {{-- Chat List --}}
        <div class="flex-1 overflow-y-auto msg-scrollbar px-4 py-4">
            @foreach ($chatTeams as $team)
                <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-cyan-800 hover:bg-cyan-700 transition duration-200 cursor-pointer">
                    <img src="{{ $team['image'] }}" class="w-10 h-10 rounded-full object-cover" alt="{{ $team['name'] }}">
                    <div class="flex-1 min-w-0">
                        <span class="font-semibold text-white">{{ $team['name'] }}</span>
                        <div class="text-cyan-200 text-sm truncate">{{ $team['last_message'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Chat Area --}}
    <div class="flex-1 flex flex-col bg-gradient-to-b from-gray-800 via-gray-900 to-gray-800 text-white">

        {{-- Chat Header --}}
        <div class="flex items-center px-6 py-5 border-b border-gray-700">
            <span class="text-gray-300 text-sm">
                Chat dengan <strong>{{ $activeChat['name'] }}</strong>
            </span>
        </div>

        {{-- Chat Body --}}
        <div class="flex-1 overflow-y-auto px-6 py-6 flex flex-col gap-6 msg-scrollbar">
            @foreach ($activeChat['messages'] as $message)
                @if ($message['from'] === 'me')
                    <div class="flex justify-end">
                        <div class="max-w-[70%]">
                            <div class="bg-cyan-600 text-white px-5 py-3 rounded-2xl rounded-br-sm shadow text-base">
                                {{ $message['text'] }}
                            </div>
                            <div class="text-xs text-right text-gray-400 mt-1">{{ $message['time'] }}</div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-start">
                        <div class="max-w-[70%]">
                            <div class="bg-gray-700 text-white px-5 py-3 rounded-2xl rounded-bl-sm shadow text-base">
                                {{ $message['text'] }}
                            </div>
                            <div class="text-xs text-left text-gray-400 mt-1">{{ $message['time'] }}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Chat Input (dummy) --}}
        <form class="flex items-center gap-3 px-6 py-5 border-t border-gray-700 bg-gray-900">
            <input
                type="text"
                class="flex-1 bg-gray-800 border border-gray-600 rounded-xl text-white px-4 py-2 focus:ring-2 focus:ring-cyan-500 outline-none"
                placeholder="Ketik pesan..."
                disabled
            />
            <button
                type="button"
                disabled
                class="ml-2 px-6 py-2 rounded-full bg-gradient-to-r from-cyan-400 to-blue-500 text-white font-semibold shadow cursor-not-allowed opacity-50"
            >
                KIRIM
            </button>
        </form>
    </div>
</div>

@endsection
