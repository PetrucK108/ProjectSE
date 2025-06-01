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
            background: #f1f5f9;
        }

        .msg-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
    </style>

    <div class="p-6 space-y-8">
        <!-- Sidebar Chat List -->
        <div class="w-full max-w-xs bg-white h-full flex flex-col border-r border-gray-200">
            <!-- Header -->
            <div class="msg-gradient-header px-6 py-5 flex items-center gap-3 rounded-br-2xl shadow">
                <img src="{{ asset('images/yasi.jpg') }}" class="w-10 h-10 rounded-full border-2 border-white" alt="Profile">
                <span class="text-white font-semibold text-lg flex-1">My Profile</span>
                <button>
                    <svg class="w-6 h-6 text-white opacity-80" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                </button>
            </div>
            <!-- Tabs -->
            <div class="flex items-center px-6 pt-4 pb-2 gap-4">
                <button class="text-gray-800 font-semibold border-b-2 border-cyan-400 pb-1">Messages
                    <span class="ml-1 bg-cyan-400 text-white rounded-full px-2 text-xs">1</span>
                </button>
                <button class="text-gray-400 font-semibold pb-1">Matches</button>
            </div>
            <!-- Chat List -->
            <div class="flex-1 overflow-y-auto msg-scrollbar px-2 py-2">
                @foreach ([['img' => 'https://randomuser.me/api/portraits/men/32.jpg', 'name' => 'David', 'msg' => 'Hey there 😊', 'active' => true], ['img' => 'https://randomuser.me/api/portraits/men/33.jpg', 'name' => 'Jaryd', 'msg' => 'Lucky', 'active' => false], ['img' => 'https://randomuser.me/api/portraits/men/34.jpg', 'name' => 'JR', 'msg' => 'Hi there', 'active' => false], ['img' => 'https://randomuser.me/api/portraits/men/35.jpg', 'name' => 'Christopher', 'msg' => 'Hi', 'active' => false], ['img' => 'https://randomuser.me/api/portraits/men/36.jpg', 'name' => 'Steve', 'msg' => 'Hi', 'active' => false], ['img' => 'https://randomuser.me/api/portraits/men/37.jpg', 'name' => 'André', 'msg' => "How's your day been?", 'active' => false], ['img' => 'https://randomuser.me/api/portraits/men/38.jpg', 'name' => 'Jake', 'msg' => 'Hi', 'active' => false], ['img' => 'https://randomuser.me/api/portraits/men/39.jpg', 'name' => 'Vin', 'msg' => 'How are you doing', 'active' => false]] as $chat)
                    <div
                        class="flex items-center gap-3 px-3 py-2 rounded-xl mb-1 cursor-pointer transition-all duration-200 {{ $chat['active'] ? 'bg-gray-100' : 'hover:bg-gray-100' }}">
                        <img src="{{ $chat['img'] }}" class="w-10 h-10 rounded-full" alt="{{ $chat['name'] }}">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-1">
                                <span class="font-semibold text-gray-800">{{ $chat['name'] }}</span>
                                @if ($chat['active'])
                                    <span class="ml-1 w-2 h-2 bg-cyan-400 rounded-full inline-block"></span>
                                @endif
                            </div>
                            <div class="text-gray-500 text-sm truncate">{{ $chat['msg'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 flex flex-col h-full bg-gradient-to-br from-[#f8fafc] via-[#f1f5f9] to-[#f8fafc]">
            <!-- Chat Top Info -->
            <div class="flex items-center px-10 py-6 border-b border-gray-300 min-h-[72px]">
                <span class="text-gray-600 text-sm">You matched with David on 12/19/2018</span>
            </div>

            <!-- Chat Messages -->
            <div class="flex-1 overflow-y-auto px-10 py-8 flex flex-col gap-6 msg-scrollbar">
                <div class="flex justify-end">
                    <div>
                        <div
                            class="bg-gradient-to-br from-cyan-400 via-blue-500 to-indigo-500 text-white px-5 py-3 rounded-2xl rounded-br-sm shadow-md text-base max-w-[60vw]">
                            Hey there 😊
                        </div>
                        <div class="text-xs text-right text-gray-500 mt-1">Just now</div>
                    </div>
                </div>

                <div class="flex justify-start">
                    <div>
                        <div
                            class="bg-white text-gray-800 px-5 py-3 rounded-2xl rounded-bl-sm shadow-md text-base max-w-[60vw] border border-gray-200">
                            Hello! Nice to meet you.
                        </div>
                        <div class="text-xs text-left text-gray-500 mt-1">Just now</div>
                    </div>
                </div>
            </div>

            <!-- Chat Input -->
            <form class="flex items-center gap-3 px-10 py-6 border-t border-gray-200 bg-white">
                <button type="button" class="text-cyan-500 hover:text-cyan-400 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M8 12h8" />
                    </svg>
                </button>
                <button type="button" class="text-cyan-500 hover:text-cyan-400 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15.172 7l-6.586 6.586a2 2 0 002.828 2.828l6.586-6.586a2 2 0 00-2.828-2.828z" />
                    </svg>
                </button>
                <input type="text"
                    class="flex-1 bg-gray-100 border border-gray-300 rounded-xl text-gray-800 text-base px-4 py-2 focus:ring-2 focus:ring-cyan-500 outline-none transition"
                    placeholder="Type a message" />
                <button type="submit"
                    class="ml-2 px-6 py-2 rounded-full bg-gradient-to-r from-cyan-400 to-blue-500 text-white font-semibold shadow hover:from-cyan-500 hover:to-blue-600 transition">
                    SEND
                </button>
            </form>
        </div>
    </div>
@endsection
