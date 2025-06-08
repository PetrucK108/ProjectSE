@extends('Sidebar.sidebar')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .card-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .team-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .team-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(59, 130, 246, 0.1);
        }
        
        .action-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .action-btn:hover::before {
            left: 100%;
        }
        
        .action-btn:hover {
            transform: scale(1.1);
        }
        
        .action-btn:active {
            transform: scale(0.95);
        }
        
        .decline-btn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        }
        
        .accept-btn {
            background: linear-gradient(135deg, #51cf66, #40c057);
            box-shadow: 0 4px 15px rgba(81, 207, 102, 0.4);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }
        
        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 1;
            }
            80%, 100% {
                transform: scale(1.2);
                opacity: 0;
            }
        }
        
        .skill-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .no-teams-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 60vh;
        }
    </style>    

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8">
        <div class="max-w-4xl mx-auto px-6">
            
            <!-- Header Section -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center pulse-ring"></div>
                        <div class="absolute inset-0 w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i data-lucide="search" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Find Your Match
                    </h1>
                </div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Temukan tim futsal yang cocok dengan skill level dan gaya bermain Anda
                </p>
            </div>

            @if($teamToShow)
                <!-- Team Card -->
                <div class="flex justify-center mb-8">
                    <div class="team-card w-full max-w-md rounded-3xl overflow-hidden floating-animation">
                        
                        <!-- Team Image -->
                        <div class="relative h-64 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent z-10"></div>
                            <img src="https://images.pexels.com/photos/274422/pexels-photo-274422.jpeg" 
                                 alt="Team Photo" 
                                 class="w-full h-full object-cover">
                            
                            <!-- Skill Badge -->
                            <div class="absolute top-4 right-4 z-20">
                                <span class="skill-badge">{{ $teamToShow->skill_level ?? 'N/A' }}</span>
                            </div>
                            
                            <!-- Team Name Overlay -->
                            <div class="absolute bottom-4 left-4 z-20">
                                <h2 class="text-white text-2xl font-bold mb-1">{{ $teamToShow->name }}</h2>
                                <div class="flex items-center gap-2 text-white/80">
                                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                                    <span class="text-sm">{{ $teamToShow->jurusan ?? 'Unknown' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Team Details -->
                        <div class="p-6">
                            <!-- Stats Grid -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="stat-card p-4 rounded-xl text-center">
                                    <div class="text-2xl font-bold text-blue-600 mb-1">
                                        {{ $teamToShow->pemain->count() ?? 0 }}
                                    </div>
                                    <div class="text-sm text-gray-600">Pemain</div>
                                </div>
                                
                                <div class="stat-card p-4 rounded-xl text-center">
                                    <div class="text-2xl font-bold text-green-600 mb-1">
                                        {{ number_format($teamToShow->avg_gol ?? 0, 1) }}
                                    </div>
                                    <div class="text-sm text-gray-600">Avg Goals</div>
                                </div>
                            </div>

                            <!-- Team Info -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i data-lucide="target" class="w-4 h-4"></i>
                                        Gaya Bermain
                                    </span>
                                    <span class="font-semibold text-gray-800">{{ $teamToShow->gaya_bermain ?? 'N/A' }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i data-lucide="shield" class="w-4 h-4"></i>
                                        Kebobolan
                                    </span>
                                    <span class="font-semibold text-gray-800">{{ number_format($teamToShow->avgConceded ?? 0, 1) }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600 flex items-center gap-2">
                                        <i data-lucide="mail" class="w-4 h-4"></i>
                                        Email
                                    </span>
                                    <span class="font-semibold text-gray-800 text-sm">{{ $teamToShow->email }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                <form method="POST" action="{{ route('swipe.action') }}" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="target_user_id" value="{{ $teamToShow->id }}">
                                    <input type="hidden" name="action" value="decline">
                                    <button type="submit" class="action-btn decline-btn w-full py-4 rounded-2xl text-white font-semibold flex items-center justify-center gap-2">
                                        <i data-lucide="x" class="w-5 h-5"></i>
                                        Pass
                                    </button>
                                </form>
                                
                                <form method="POST" action="{{ route('swipe.action') }}" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="target_user_id" value="{{ $teamToShow->id }}">
                                    <input type="hidden" name="action" value="accept">
                                    <button type="submit" class="action-btn accept-btn w-full py-4 rounded-2xl text-white font-semibold flex items-center justify-center gap-2">
                                        <i data-lucide="heart" class="w-5 h-5"></i>
                                        Like
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Section -->
                <div class="glass-effect rounded-2xl p-6 text-center">
                    <div class="flex items-center justify-center gap-2 mb-3">
                        <i data-lucide="lightbulb" class="w-5 h-5 text-yellow-500"></i>
                        <span class="font-semibold text-gray-700">Tips</span>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Swipe right untuk menyukai tim, atau swipe left untuk melewati. 
                        Tim dengan skill level dan gaya bermain yang cocok akan diprioritaskan!
                    </p>
                </div>

            @else
                <!-- No Teams Available -->
                <div class="no-teams-container rounded-3xl p-12 text-center text-white">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 mx-auto mb-6 bg-white/20 rounded-full flex items-center justify-center">
                            <i data-lucide="users" class="w-12 h-12"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Tidak Ada Tim Lagi</h3>
                        <p class="text-white/80 mb-6">
                            Anda sudah melihat semua tim yang tersedia. Coba lagi nanti atau ajak teman untuk bergabung!
                        </p>
                        <a href="{{ route('profil') }}" 
                           class="inline-flex items-center gap-2 bg-white text-purple-600 px-6 py-3 rounded-xl font-semibold hover:bg-white/90 transition">
                            <i data-lucide="settings" class="w-4 h-4"></i>
                            Update Profil Tim
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>
@endsection