@extends('Sidebar.sidebar')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Inter', sans-serif; }
    .matches-bg {
        background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ef 100%);
        min-height: 100vh;
        width: 100%;
        padding-bottom: 4rem;
    }
    .matches-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 2.5rem;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }
    .enemy-card {
        background: #fff;
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.10);
        overflow: hidden;
        transition: transform 0.4s cubic-bezier(.4,0,.2,1), box-shadow 0.4s;
        animation: fadeInUp 0.7s cubic-bezier(.4,0,.2,1);
        position: relative;
        width: 100%;
        min-width: 320px;
        max-width: 400px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .enemy-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 12px 32px 0 rgba(31, 38, 135, 0.18);
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px);}
        to { opacity: 1; transform: translateY(0);}
    }
    .enemy-header {
        background: linear-gradient(90deg, #232b36 60%, #23234a 100%);
        color: #fff;
        font-weight: 700;
        font-size: 1.15rem;
        padding: 1.1rem 0;
        text-align: center;
        letter-spacing: 0.01em;
        width: 100%;
        border-bottom: 2px solid #3b82f6;
    }
    .enemy-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem 1.5rem 1.5rem 1.5rem;
        background: #fff;
        width: 100%;
    }
    .enemy-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #232b36;
        box-shadow: 0 2px 12px 0 rgba(31, 38, 135, 0.10);
        background: #f1f5f9;
        margin-bottom: 1.1rem;
    }
    .stat-badge {
        background: #f1f5f9;
        color: #232b36;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 9999px;
        padding: 0.25rem 1.1rem;
        margin: 0 0.2rem;
        display: inline-block;
    }
    .enemy-meta {
        font-size: 1rem;
        font-weight: 400;
        color: #232b36;
        margin-bottom: 0.1rem;
    }
    .enemy-btn {
        background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
        color: #fff;
        border-radius: 2rem;
        padding: 1rem 2.5rem;
        font-weight: 700;
        font-size: 1.15rem;
        margin-top: 2rem;
        margin-bottom: 0.5rem;
        transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        box-shadow: 0 4px 16px 0 rgba(6,182,212,0.13), 0 2px 8px 0 rgba(99,102,241,0.10);
        justify-content: center;
        position: relative;
        overflow: hidden;
        left: 50%;
        transform: translateX(-50%);
    }
    .enemy-btn::before {
        content: '';
        position: absolute;
        left: -60%;
        top: 0;
        width: 60%;
        height: 100%;
        background: linear-gradient(90deg,rgba(255,255,255,0.15) 0%,rgba(255,255,255,0.05) 100%);
        transform: skewX(-20deg);
        transition: left 0.4s;
        z-index: 1;
    }
    .enemy-btn:hover::before {
        left: 110%;
    }
    .enemy-btn:hover {
        background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
        transform: scale(1.07) translateX(-50%);
        box-shadow: 0 8px 32px 0 rgba(6,182,212,0.18), 0 2px 8px 0 rgba(99,102,241,0.13);
    }
    .enemy-btn i {
        z-index: 2;
    }
    .enemy-btn span {
        z-index: 2;
    }
    .enemy-jurusan {
        color: #6366f1;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        text-align: center;
    }
    .enemy-angkatan {
        color: #0ea5e9;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        text-align: center;
        letter-spacing: 0.01em;
    }
    @media (max-width: 900px) {
        .matches-grid { grid-template-columns: 1fr; }
        .enemy-card { min-width: 0; max-width: 100%; }
    }
</style>

<div class="matches-bg flex flex-col items-center py-8 px-2 overflow-auto max-w-full">
    <div class="w-full flex flex-col items-center mb-8">
        <div class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-indigo-500 to-purple-600 mb-2 tracking-tight drop-shadow-lg">
            <i data-lucide="trophy" class="inline w-10 h-10 mb-2 text-blue-500"></i>
            Recent Matches
        </div>
        <div class="text-lg text-gray-500 font-medium mb-2">Lihat lawan-lawan terakhir yang sudah match dengan timmu!</div>
    </div>
    @php
        $myUserId = Auth::id();
        $enemyMatches = [];
        foreach ($matches as $match) {
            $enemy = $match->team1_id == $myUserId ? $match->team2 : $match->team1;
            $enemyPhoto = $enemy->foto_profil ? asset('storage/' . $enemy->foto_profil) : asset('images/default-team.png');
            $enemySquad = $enemy->pemain ?? collect();
            // Ambil semua angkatan unik, urutkan, lalu ambil range
            $angkatanArr = $enemySquad->pluck('angkatan')->filter()->unique()->sort()->values();
            $angkatanRange = $angkatanArr->count() > 0
                ? ($angkatanArr->count() === 1 ? $angkatanArr[0] : $angkatanArr->first() . ' - ' . $angkatanArr->last())
                : '-';
            $enemyMatches[] = [
                'name' => $enemy->name ?? '-',
                'photo' => $enemyPhoto,
                'jurusan' => $enemy->jurusan ?? '-',
                'angkatan' => $angkatanRange,
                'skill' => $enemy->skill_level ?? '-',
                'playstyle' => $enemy->gaya_bermain ?? '-',
                'id' => $enemy->id,
            ];
        }
    @endphp

    @if(count($enemyMatches))
        <div class="matches-grid mt-2 w-full max-w-full">
            @foreach($enemyMatches as $enemy)
                <div class="enemy-card">
                    <div class="enemy-header">{{ $enemy['name'] }}</div>
                    <div class="enemy-content">
                        <img src="{{ $enemy['photo'] }}" class="enemy-avatar shadow-lg" alt="Foto Tim Musuh">
                        <div class="enemy-jurusan">{{ $enemy['jurusan'] }}</div>
                        <div class="enemy-angkatan">Angkatan: {{ $enemy['angkatan'] }}</div>
                        <div class="enemy-meta">Skill: <b>{{ $enemy['skill'] }}</b></div>
                        <div class="enemy-meta">Playstyle: <b>{{ $enemy['playstyle'] }}</b></div>
                        <!-- Button Message Baru -->
                        <div class="flex w-full justify-center mt-6">
                            <a href="{{ route('message.addContact', ['enemyId' => $enemy['id']]) }}"
                                class="flex items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 shadow-lg hover:scale-110 hover:shadow-2xl transition-all duration-200 w-14 h-14">
                                <!-- SVG chat bubble polos -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 32 32" stroke="currentColor" stroke-width="2">
                                    <ellipse cx="16" cy="14" rx="13" ry="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                    <path d="M7 24c2.5 1.5 5.5 2.5 9 2.5s6.5-1 9-2.5" stroke="currentColor" stroke-width="2" fill="none"/>
                                    <path d="M7 24c-2 1.5-3 2.5-3 2.5s2.5 0 6-2" stroke="currentColor" stroke-width="2" fill="none"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-500 py-16">
            Belum ada match yang ditemukan.
        </div>
    @endif
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.lucide) lucide.createIcons();
    });
</script>
@endsection
