@extends('Sidebar.sidebar')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    html, body {
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden !important;
        box-sizing: border-box;
    }
    body { font-family: 'Inter', sans-serif; }
    .swipe-bg {
        height: 100%;
        width: 100%;
        background: linear-gradient(135deg, #e0e7ef 0%, #f8fafc 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding: 0;
        margin: 0;
        overflow: hidden !important;
        box-sizing: border-box;
    }
    .swipe-header {
        margin-top: 2.5rem;
        margin-bottom: 1.5rem;
        text-align: center;
        width: 100%;
        flex-shrink: 0;
    }
    .swipe-title {
        font-size: 2.2rem;
        font-weight: 900;
        background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
        color: transparent;
        background-clip: text;
        -webkit-background-clip: text;
        letter-spacing: 0.01em;
        margin-bottom: 0.3rem;
        display: inline-block;
        line-height: 1.1;
    }
    .swipe-card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: calc(100vh - 120px);
        min-height: 0;
        margin: 0;
        padding: 0;
        overflow: hidden;
        position: relative;
    }
    .swipe-card {
        width: 320px;
        max-width: 92vw;
        border-radius: 1.5rem;
        background: #fff;
        box-shadow: 0 8px 32px 0 rgba(31,38,135,0.13), 0 2px 8px 0 rgba(99,102,241,0.09);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: box-shadow 0.3s, transform 0.4s cubic-bezier(.4,0,.2,1);
        overflow: hidden;
        min-height: 400px;
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: stretch;
        padding: 0;
        border: none;
        backdrop-filter: blur(8px);
        box-sizing: border-box;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px);}
        to { opacity: 1; transform: translateY(0);}
    }
    .swipe-card.swipe-left {
        animation: swipeLeft 0.5s forwards;
    }
    .swipe-card.swipe-right {
        animation: swipeRight 0.5s forwards;
    }
    @keyframes swipeLeft {
        to { transform: translateX(-120vw) rotate(-12deg); opacity: 0; }
    }
    @keyframes swipeRight {
        to { transform: translateX(120vw) rotate(12deg); opacity: 0; }
    }
    .team-photo {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-top-left-radius: 1.5rem;
        border-top-right-radius: 1.5rem;
        background: #e0e7ef;
        position: relative;
        border-bottom: 2px solid #6366f1;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .team-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: inherit;
        filter: brightness(0.98) contrast(1.08);
        transition: transform 0.3s;
    }
    .team-badge {
        position: absolute;
        top: 0.7rem;
        left: 0.7rem;
        background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
        color: #fff;
        font-size: 0.95rem;
        font-weight: 700;
        border-radius: 1.2rem;
        padding: 0.22rem 0.8rem;
        letter-spacing: 0.04em;
        z-index: 2;
        border: 2px solid #fff;
        text-shadow: 0 2px 8px #23234a30;
    }
    .team-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: center;
        background: transparent;
        padding: 1rem 1rem 0.8rem 1rem;
        position: relative;
    }
    .team-name {
        font-size: 1.15rem;
        font-weight: 900;
        color: #23234a;
        margin-bottom: 0.2rem;
        letter-spacing: 0.01em;
        text-shadow: 0 2px 8px #e0e7ef80;
        line-height: 1.1;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .team-jurusan {
        font-size: 0.95rem;
        color: #6366f1;
        font-weight: 600;
        margin-bottom: 0.7rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .team-squad {
        display: flex;
        gap: 0.7rem;
        margin-bottom: 0.7rem;
        justify-content: center;
    }
    .squad-stat {
        background: linear-gradient(90deg, #f1f5f9 60%, #e0e7ef 100%);
        border-radius: 1.2rem;
        padding: 0.5rem 0.7rem;
        text-align: center;
        min-width: 48px;
        border: 1.5px solid #6366f1;
        font-size: 0.95rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .squad-stat-label {
        color: #64748b;
        font-size: 0.92rem;
        font-weight: 500;
    }
    .squad-stat-value {
        color: #23234a;
        font-size: 1rem;
        font-weight: 800;
        margin-bottom: 0.1rem;
        letter-spacing: 0.01em;
    }
    .team-detail-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        gap: 0.7rem;
    }
    .team-detail-label {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .team-detail-value {
        color: #23234a;
        font-size: 1rem;
        font-weight: 800;
        letter-spacing: 0.01em;
    }
    .swipe-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        align-items: center;
        margin-top: 0.7rem;
        margin-bottom: 0.7rem;
    }
    .swipe-btn {
        border: none;
        outline: none;
        border-radius: 2rem;
        font-size: 1rem;
        font-weight: 700;
        padding: 0.7rem 1.5rem;
        cursor: pointer;
        box-shadow: 0 2px 12px 0 rgba(31,38,135,0.10);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.2s, transform 0.2s;
        position: relative;
        overflow: hidden;
        letter-spacing: 0.01em;
        border: none;
    }
    .swipe-btn.decline {
        background: linear-gradient(90deg, #ff6b6b 0%, #ee5a52 100%);
        color: #fff;
    }
    .swipe-btn.accept {
        background: linear-gradient(90deg, #51cf66 0%, #40c057 100%);
        color: #fff;
    }
    .swipe-btn:active {
        transform: scale(0.96);
    }
    .swipe-btn i {
        filter: drop-shadow(0 2px 8px #23234a22);
    }
    /* Responsive */
    @media (max-width: 600px) {
        .swipe-header { margin-top: 1.2rem; margin-bottom: 0.7rem; }
        .swipe-title { font-size: 1.2rem; }
        .swipe-card { width: 98vw; min-width: 0; min-height: 220px; margin-top: 0; margin-bottom: 12px; border-radius: 1.2rem; }
        .team-photo { width: 100%; height: 80px; border-radius: 1.2rem 1.2rem 0 0; }
        .team-info { padding: 0.7rem 0.7rem 0.5rem 0.7rem; }
        .team-name { font-size: 0.98rem; }
        .team-jurusan { font-size: 0.85rem; }
        .swipe-actions { gap: 0.5rem; }
        .swipe-btn { font-size: 0.92rem; padding: 0.5rem 1rem; }
        .squad-stat { min-width: 32px; padding: 0.3rem 0.5rem; font-size: 0.85rem; }
        .squad-stat-label { font-size: 0.82rem; }
        .squad-stat-value { font-size: 0.92rem; }
        .swipe-card-container { height: calc(100vh - 100px); }
    }
    @media (max-width: 400px) {
        .swipe-card { width: 100vw; }
    }
</style>

<div class="swipe-bg">
    <div class="swipe-header">
        <div class="swipe-title">
            <i data-lucide="users" class="inline w-8 h-8 text-blue-500 mb-1"></i>
            Temukan Lawan Tim Futsal
        </div>
    </div>
    @if($teamToShow)
    <div class="swipe-card-container w-full max-w-full">
        <form id="swipeForm" method="POST" action="{{ route('swipe.action') }}" class="swipe-card"
            autocomplete="off">
            @csrf
            <input type="hidden" name="target_user_id" value="{{ $teamToShow->id }}">
            <input type="hidden" name="action" id="swipeAction" value="">
            <div class="team-photo relative">
                <img src="{{ $teamToShow->foto_profil ? asset('storage/' . $teamToShow->foto_profil) : asset('images/default-team.png') }}"
                    alt="Team Photo">
            </div>
            <div class="team-info">
                <div class="team-name">{{ $teamToShow->name }}</div>
                <div class="team-jurusan">
                    <i data-lucide="book" class="w-4 h-4"></i>
                    {{ $teamToShow->jurusan ?? '-' }}
                </div>
                <div class="team-squad gap-2 mb-2">
                    <div class="squad-stat min-w-[60px] p-2">
                        <div class="squad-stat-value">{{ $teamToShow->pemain->count() ?? 0 }}</div>
                        <div class="squad-stat-label">Squad Size</div>
                    </div>
                    <div class="squad-stat min-w-[60px] p-2">
                        <div class="squad-stat-value">
                            {{ $teamToShow->pemain->count() > 0 ? number_format($teamToShow->pemain->avg('umur'), 1) : '-' }}
                        </div>
                        <div class="squad-stat-label">Avg Age</div>
                    </div>
                </div>
                <div class="team-detail-row mb-2">
                    <span class="team-detail-label"><i data-lucide="target" class="w-4 h-4"></i>Playstyle</span>
                    <span class="team-detail-value">{{ $teamToShow->gaya_bermain ?? '-' }}</span>
                </div>
                <div class="team-detail-row mb-2">
                    <span class="team-detail-label"><i data-lucide="star" class="w-4 h-4"></i>Skill Level</span>
                    <span class="team-detail-value">{{ $teamToShow->skill_level ?? '-' }}</span>
                </div>
                <div class="swipe-actions gap-3 mt-2 mb-2">
                    <button type="button" class="swipe-btn decline" id="declineBtn">
                        <i data-lucide="x" class="w-5 h-5"></i> Pass
                    </button>
                    <button type="button" class="swipe-btn accept" id="acceptBtn">
                        <i data-lucide="heart" class="w-5 h-5"></i> Like
                    </button>
                </div>
            </div>
        </form>
    </div>
    @else
    <div class="flex flex-col items-center justify-center w-full h-[70vh]">
        <div class="relative flex flex-col items-center justify-center">
            <div class="absolute inset-0 w-64 h-64 rounded-full bg-gradient-to-br from-blue-200/60 via-indigo-100/70 to-purple-100/70 blur-2xl animate-pulse"></div>
            <div class="relative z-10 flex flex-col items-center">
                <div class="rounded-full bg-gradient-to-br from-blue-400 via-indigo-400 to-purple-400 shadow-xl p-6 mb-4 animate-bounce">
                    <i data-lucide="users" class="w-14 h-14 text-white"></i>
                </div>
                <div class="text-2xl font-bold text-gray-800 mb-2 drop-shadow">Tidak Ada Tim Lagi</div>
                <div class="text-base text-gray-600 mb-4 text-center max-w-xs">
                    Anda sudah melihat semua tim yang tersedia.<br>
                    Coba lagi nanti atau ajak teman untuk bergabung!
                </div>
                <a href="{{ route('profil') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow-lg hover:scale-105 hover:shadow-2xl transition-all duration-300 text-base mt-2">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Update Profil Tim
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        lucide.createIcons();

        const card = document.querySelector('.swipe-card');
        const declineBtn = document.getElementById('declineBtn');
        const acceptBtn = document.getElementById('acceptBtn');
        const swipeForm = document.getElementById('swipeForm');
        const swipeAction = document.getElementById('swipeAction');

        function animateAndSubmit(direction) {
            if (!card) return;
            card.classList.remove('swipe-left', 'swipe-right');
            if (direction === 'left') {
                card.classList.add('swipe-left');
                swipeAction.value = 'decline';
            } else {
                card.classList.add('swipe-right');
                swipeAction.value = 'accept';
            }
            setTimeout(() => swipeForm.submit(), 450);
        }

        if (declineBtn) {
            declineBtn.addEventListener('click', function(e) {
                e.preventDefault();
                animateAndSubmit('left');
            });
        }
        if (acceptBtn) {
            acceptBtn.addEventListener('click', function(e) {
                e.preventDefault();
                animateAndSubmit('right');
            });
        }
    });
</script>
@endsection