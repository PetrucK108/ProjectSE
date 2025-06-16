@extends('Sidebar.sidebar')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<style>
    body { font-family: 'Inter', sans-serif; }
    .chat-container {
        width: 100%;
        height: 100%;
        min-height: 0;
        min-width: 0;
        display: flex;
        background: #fff;
        position: relative;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .card-user {
        background: #fff;
        border-right: 2px solid #3b82f6;
        width: 240px;
        min-width: 240px;
        max-width: 240px;
        height: 100%;
        display: flex;
        flex-direction: column;
        padding: 0;
        margin: 0;
    }
    .card-chat {
        background: #fff;
        flex: 1 1 0%;
        min-width: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
        padding: 0;
        margin: 0;
    }
    .contact-active { background: #e0e7ef !important; }
    .sidebar-contact {
        transition: background 0.2s, transform 0.2s;
        position: relative;
    }
    .sidebar-contact:hover {
        background: #e0e7ef;
        transform: scale(1.03);
    }
    .sidebar-contact .sidebar-avatar {
        transition: box-shadow 0.2s;
    }
    .sidebar-contact:hover .sidebar-avatar {
        box-shadow: 0 0 0 3px #6366f1;
    }
    .notif-dot {
        width: 12px; height: 12px; border-radius: 9999px; background: #ef4444;
        position: absolute; right: 18px; top: 28px; box-shadow: 0 0 0 2px #fff;
        animation: notif-bounce 1s infinite alternate;
    }
    @keyframes notif-bounce {
        0% { transform: scale(1);}
        100% { transform: scale(1.3);}
    }
    .chat-header {
        background: #e0e7ef;
        border-bottom: 1.5px solid #e5e7eb;
        padding: 1.2rem 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .chat-header .chat-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #23234a;
    }
    .chat-header .chat-jurusan {
        font-size: 1rem;
        color: #6366f1;
        font-weight: 500;
        margin-left: 0.5rem;
    }
    .chat-bubble-me { background: #6366f1; color: #fff; align-self: flex-end; }
    .chat-bubble-other { background: #e0e7ef; color: #23234a; align-self: flex-start; }
    .chat-bubble-me, .chat-bubble-other {
        transition: background 0.2s, transform 0.2s;
        animation: fadeInChat 0.4s;
    }
    @keyframes fadeInChat {
        from { opacity: 0; transform: translateY(20px);}
        to { opacity: 1; transform: translateY(0);}
    }
    .chat-input-area {
        background: #f3f4f6;
        border-top: 1.5px solid #e5e7eb;
        padding: 1.2rem 2rem;
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    .chat-input {
        background: #fff;
        color: #23234a;
        border-radius: 9999px;
        padding: 0.7rem 1.2rem;
        border: 1.5px solid #e5e7eb;
        width: 100%;
        font-size: 1.05rem;
        transition: box-shadow 0.2s, border 0.2s;
    }
    .chat-input:focus {
        outline: none;
        border: 1.5px solid #6366f1;
        box-shadow: 0 0 0 2px #6366f1;
    }
    .send-btn {
        background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 9999px;
        padding: 0.6rem 1.8rem;
        font-weight: 700;
        font-size: 1.05rem;
        transition: background 0.2s, transform 0.2s;
        border: none;
    }
    .send-btn:hover {
        background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
        transform: scale(1.05);
    }
</style>
@php
    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;
    $myId = Auth::id();
    // Hitung unread message per contact (pesan dari lawan yang belum dibaca)
    $unreadCounts = [];
    foreach ($contacts as $contact) {
        $unreadCounts[$contact->contact_user_id] = \App\Models\Message::where('from_user_id', $contact->contact_user_id)
            ->where('to_user_id', $myId)
            ->whereNull('read_at')->count();
    }
@endphp
<div class="chat-container h-full min-h-0 w-full max-w-full">
    <!-- Card User (Daftar Kontak) -->
    <div class="card-user h-full min-h-0 max-w-xs w-full">
        <div class="p-6 text-xl font-bold border-b border-blue-100 tracking-tight">Pesan Tim</div>
        <div class="flex-1 py-2 overflow-hidden">
            @forelse($contacts as $contact)
                @php
                    $user = $contact->contactUser;
                @endphp
                <a href="{{ route('message.with', ['contactId' => $contact->contact_user_id]) }}"
                   class="sidebar-contact flex items-center gap-4 px-4 py-3 transition-all duration-200 {{ isset($selectedContact) && $selectedContact->id == $contact->contact_user_id ? 'contact-active' : '' }}">
                    <img src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/default-team.png') }}"
                         class="sidebar-avatar w-10 h-10 rounded-full object-cover border border-gray-300 shadow">
                    <div class="flex flex-col">
                        <div class="font-semibold text-base">{{ $user->name }}</div>
                        <div class="text-xs text-blue-600">{{ $user->jurusan ?? '-' }}</div>
                    </div>
                    @if(($unreadCounts[$contact->contact_user_id] ?? 0) > 0)
                        <span class="notif-dot"></span>
                    @endif
                </a>
            @empty
                <div class="p-4 text-gray-400">Belum ada kontak.</div>
            @endforelse
        </div>
    </div>
    <!-- Card Chat (Isi Pesan) -->
    <div class="card-chat flex-[3] h-full min-h-0 w-full max-w-full">
        @if($selectedContact)
            <div class="chat-header">
                <img src="{{ $selectedContact->foto_profil ? asset('storage/' . $selectedContact->foto_profil) : asset('images/default-team.png') }}"
                     class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow">
                <div>
                    <div class="chat-title">{{ $selectedContact->name }}</div>
                    <div class="chat-jurusan">{{ $selectedContact->jurusan ?? '-' }}</div>
                </div>
            </div>
            <div class="flex-1 flex flex-col gap-3 px-6 py-6 min-h-0" style="background:#fff;">
                <div class="flex flex-col gap-2 flex-1 min-h-0" style="overflow-y:auto;">
                    @foreach($messages as $msg)
                        <div class="flex flex-col {{ $msg->from_user_id == $myId ? 'items-end' : 'items-start' }}">
                            <div class="px-4 py-2 rounded-2xl max-w-xs text-base mb-1 shadow
                                {{ $msg->from_user_id == $myId ? 'chat-bubble-me' : 'chat-bubble-other' }}">
                                {{ $msg->content }}
                            </div>
                            <span class="text-xs text-gray-400 mb-2">
                                {{ \Carbon\Carbon::parse($msg->created_at)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <form action="{{ route('message.send', ['contactId' => $selectedContact->id]) }}" method="POST" class="chat-input-area">
                @csrf
                <input type="text" name="content" class="chat-input" placeholder="Ketik pesan..." required autocomplete="off">
                <button type="submit" class="send-btn">Kirim</button>
            </form>
        @else
            <div class="flex-1 flex items-center justify-center text-gray-400 text-lg">Pilih kontak untuk mulai chat.</div>
        @endif
    </div>
</div>
<script>
    // Scroll ke bawah otomatis saat buka chat
    document.addEventListener("DOMContentLoaded", function() {
        if (window.lucide) lucide.createIcons();
        let chatScroll = document.querySelector('.flex.flex-col.gap-2.flex-1');
        if(chatScroll) chatScroll.scrollTop = chatScroll.scrollHeight;
    });
</script>
@endsection
