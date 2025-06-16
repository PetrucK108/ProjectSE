@extends('Sidebar.sidebar')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.13/dist/cropper.min.js"></script>
<style>
    body { font-family: 'Inter', sans-serif; }
    .profile-panel {
        background: #fff;
        border-radius: 2rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
        border: 1.5px solid #e0e7ef;
        padding: 2.5rem 2rem;
        min-width: 320px;
    }
    .profile-avatar {
        box-shadow: 0 4px 24px 0 rgba(6, 182, 212, 0.15);
        background: #23234a;
    }
    .profile-section-title { letter-spacing: 0.02em; }
    .profile-label { font-weight: 600; color: #64748b; }
    .profile-value { font-weight: 700; color: #0f172a; }
    .profile-badge {
        background: linear-gradient(90deg, #23234a 0%, #181829 100%);
        color: white;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 9999px;
        padding: 0.3rem 1.1rem;
        display: inline-block;
        margin-left: 0.5rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .profile-badge:hover {
        background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
    }
    .profile-info-row {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        margin-bottom: 0.7rem;
    }
    .profile-info-label {
        color: #64748b;
        font-weight: 600;
        min-width: 110px;
    }
    .profile-info-value {
        color: #23234a;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .divider {
        border-bottom: 1.5px solid #e5e7eb;
        margin: 1.5rem 0;
    }
    .modern-table th, .modern-table td {
        border-bottom: 1.5px solid #e5e7eb;
        padding: 0.7rem 0.5rem;
        text-align: center;
    }
    .modern-table th {
        background: #23234a;
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.01em;
    }
    .modern-table tr:last-child td {
        border-bottom: none;
    }
    .modern-table tr {
        transition: background 0.18s;
    }
    .modern-table tr:hover {
        background: #f1f5f9;
    }
    .modern-table .empty-row td {
        color: #cbd5e1;
    }
    .modern-btn {
        background: #23234a;
        color: #fff;
        font-weight: 700;
        border-radius: 1rem;
        padding: 0.6rem 1.2rem;
        transition: background 0.2s, transform 0.2s;
        box-shadow: none;
        border: none;
        outline: none;
        cursor: pointer;
        text-align: center;
        font-size: 1rem;
    }
    .modern-btn:hover {
        background: #181829;
        transform: scale(1.04);
    }
    .feature-card {
        background: linear-gradient(135deg, #f8fafc 60%, #e0e7ef 100%);
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px 0 rgba(31, 38, 135, 0.10);
        border: 1.5px solid #e0e7ef;
        padding: 2rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.7rem;
        min-width: 0;
        min-height: 180px;
        height: 220px;
        justify-content: flex-start;
    }
    .feature-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #23234a;
        margin-bottom: 0.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .feature-desc {
        color: #64748b;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }
    /* Custom select style for dark bg */
    .profile-badge.select-custom {
        background: linear-gradient(90deg, #23234a 0%, #6366f1 100%);
        color: #fff;
        border: none;
        padding-right: 2.2rem;
        appearance: none;
        position: relative;
        font-weight: 700;
    }
    .profile-badge.select-custom:focus {
        outline: 2px solid #6366f1;
        outline-offset: 2px;
    }
    .profile-badge.select-custom option {
        color: #23234a;
        background: #fff;
        font-weight: 600;
    }
    .select-arrow {
        pointer-events: none;
        position: absolute;
        right: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #fff;
    }
    /* Agar feature-card bawah rata */
    .features-row {
        display: flex;
        gap: 2rem;
        width: 100%;
    }
    @media (max-width: 1024px) {
        .flex.flex-col.lg\:flex-row.gap-8.items-start {
            flex-direction: column !important;
            gap: 1.5rem !important;
        }
        .profile-panel {
            width: 100% !important;
            min-width: 0 !important;
            padding: 1.5rem 0.7rem !important;
        }
        .feature-card {
            min-width: 0 !important;
            width: 100% !important;
            padding: 1.2rem 0.7rem !important;
        }
    }
    @media (max-width: 700px) {
        .max-w-6xl {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        .profile-panel, .feature-card {
            border-radius: 1rem !important;
            padding: 1rem 0.3rem !important;
        }
        .profile-avatar {
            width: 80px !important;
            height: 80px !important;
        }
        .modern-table th, .modern-table td {
            font-size: 0.92rem !important;
            padding: 0.4rem 0.2rem !important;
        }
        .feature-title { font-size: 1rem !important; }
        .feature-desc { font-size: 0.95rem !important; }
    }
    @media (max-width: 500px) {
        .profile-panel, .feature-card {
            border-radius: 0.5rem !important;
            padding: 0.5rem 0.1rem !important;
        }
        .profile-avatar {
            width: 56px !important;
            height: 56px !important;
        }
        .modern-table th, .modern-table td {
            font-size: 0.85rem !important;
        }
    }
</style>

<div class="max-w-6xl mx-auto py-8 px-2 flex flex-col gap-8">
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 shadow-md text-center font-semibold">
            {{ session('error') }}
        </div>
    @endif
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        <!-- Left: Profile Info -->
        <div class="profile-panel flex flex-col gap-6 w-full lg:w-[420px] xl:w-[480px] min-w-[320px]">
            @php $user = Auth::user(); @endphp
            <div class="flex flex-col items-center gap-2">
                <img src="{{ $user && $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/default-user.png') }}"
                    class="profile-avatar w-28 h-28 rounded-full object-cover border-4 border-[#23234a] bg-white"
                    alt="Team Profile Photo" id="mainProfilePhoto">
                <button id="editProfileBtn" type="button"
                    class="mt-3 w-full modern-btn flex items-center justify-center gap-2 text-sm shadow">
                    <i data-lucide="edit" class="inline w-4 h-4"></i> Edit Profile
                </button>
            </div>
            <div class="divider"></div>
            <div class="flex flex-col gap-2">
                <div class="profile-info-row">
                    <span class="profile-info-label">Team Name</span>
                    <span class="profile-info-value">{{ $user->name }}</span>
                </div>
                <div class="profile-info-row">
                    <span class="profile-info-label">Email</span>
                    <span class="profile-info-value">{{ $user->email }}</span>
                </div>
                @if ($user->phone)
                <div class="profile-info-row">
                    <span class="profile-info-label">Phone</span>
                    <span class="profile-info-value">{{ $user->phone }}</span>
                </div>
                @endif
            </div>
            <div class="divider"></div>
            <div class="flex flex-row gap-4 justify-between">
                <div class="flex flex-col items-center flex-1">
                    <div class="profile-label mb-1">Squad Size</div>
                    <div class="profile-value text-2xl">{{ $squadSize }}</div>
                </div>
                <div class="flex flex-col items-center flex-1">
                    <div class="profile-label mb-1">Avg Age</div>
                    <div class="profile-value text-2xl">{{ number_format($avgAge, 1) }}</div>
                </div>
            </div>
            <div class="divider"></div>
            <div>
                <div class="profile-section-title flex items-center gap-2">
                    <i data-lucide="settings" class="w-5 h-5 text-[#23234a]"></i> Team Profile
                </div>
                <form id="teamProfileForm" method="POST" action="{{ route('profil.tim.update') }}" class="flex flex-col gap-3 items-start mt-2 relative">
                    @csrf
                    <div>
                        <span class="profile-label">Skill Level</span>
                        <div class="relative mt-2">
                            <select name="skill_level" id="skillLevelSelect" class="profile-badge select-custom pr-8 w-56" required>
                                <option value="" disabled {{ empty($user->skill_level) ? 'selected' : '' }}>Pilih Skill Level</option>
                                <option value="1" {{ $user->skill_level == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="2" {{ $user->skill_level == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="3" {{ $user->skill_level == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                <option value="4" {{ $user->skill_level == 'Professional' ? 'selected' : '' }}>Professional</option>
                            </select>
                            <span class="select-arrow"><i data-lucide="chevron-down" class="w-4 h-4"></i></span>
                        </div>
                    </div>
                    <div>
                        <span class="profile-label">Playstyle</span>
                        <div class="relative mt-2">
                            <select name="gaya_bermain" id="playstyleSelect" class="profile-badge select-custom pr-8 w-56" required>
                                <option value="" disabled {{ empty($user->gaya_bermain) ? 'selected' : '' }}>Pilih Playstyle</option>
                                <option value="1" {{ $user->gaya_bermain == 'Ultra Defensive' ? 'selected' : '' }}>Ultra Defensive</option>
                                <option value="2" {{ $user->gaya_bermain == 'Defensive' ? 'selected' : '' }}>Defensive</option>
                                <option value="3" {{ $user->gaya_bermain == 'Balanced' ? 'selected' : '' }}>Balanced</option>
                                <option value="4" {{ $user->gaya_bermain == 'Attacking' ? 'selected' : '' }}>Attacking</option>
                                <option value="5" {{ $user->gaya_bermain == 'Ultra Attacking' ? 'selected' : '' }}>Ultra Attacking</option>
                            </select>
                            <span class="select-arrow"><i data-lucide="chevron-down" class="w-4 h-4"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="modern-btn mt-2 w-32 h-10 text-base font-semibold bg-gray-800 hover:bg-gray-900 transition-all shadow-none" style="border-radius:0.75rem;">
                        Save
                    </button>
                </form>
            </div>
        </div>
        <!-- Right: Squad Table & Features -->
        <div class="flex-1 min-w-0 flex flex-col gap-8">
            <div class="profile-panel p-8 w-full">
                <div class="flex items-center justify-between mb-4">
                    <div class="profile-section-title flex items-center gap-2">
                        <i data-lucide="users" class="w-5 h-5 text-[#23234a]"></i> Squad
                    </div>
                    <div class="flex gap-2">
                        <button id="viewMoreSquadBtn"
                            class="modern-btn flex items-center gap-2 text-sm px-4 py-2 bg-gray-700 hover:bg-gray-900"
                            type="button">
                            <i data-lucide="eye" class="w-5 h-5"></i> View Full Squad
                        </button>
                        <button id="showAddPlayerModal"
                            class="modern-btn flex items-center gap-2 text-sm">
                            <i data-lucide="user-plus" class="w-5 h-5"></i> Add Player
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="modern-table w-full text-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Age</th>
                                <th>Position</th>
                                <th>Batch</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Tampilkan hanya 5 pemain pertama --}}
                            @php $maxRows = 13; $defaultRows = 5; @endphp
                            @for ($i = 0; $i < min($defaultRows, count($players)); $i++)
                                @php $p = $players[$i] ?? null; @endphp
                                <tr class="{{ $p ? '' : 'empty-row' }}">
                                    <td>
                                        @if($p)
                                            <i data-lucide="user" class="w-4 h-4 text-[#23234a]"></i> {{ $p->nama }}
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $p ? $p->nomor : '-' }}
                                    </td>
                                    <td>
                                        {{ $p ? $p->umur : '-' }}
                                    </td>
                                    <td>
                                        @if($p)
                                            <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-semibold text-xs">
                                                {{ $p->posisi }}
                                            </span>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $p ? $p->angkatan : '-' }}
                                    </td>
                                    <td>
                                        @if($p)
                                            <form action="{{ route('profil.destroy', $p->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this player?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="modern-btn px-3 py-1 text-xs shadow">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                            {{-- Jika kurang dari defaultRows, tambahkan baris kosong --}}
                            @for ($i = count($players); $i < $defaultRows; $i++)
                                <tr class="empty-row">
                                    <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal Full Squad List -->
            <div id="fullSquadModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl relative flex flex-col items-center p-8"
                     style="max-height:90vh;overflow-y:auto;">
                    <button type="button" id="closeFullSquadModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                    <h3 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2">
                        <i data-lucide="users" class="w-5 h-5"></i> Full Squad List
                    </h3>
                    <div class="w-full overflow-x-auto">
                        <table class="modern-table w-full text-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Age</th>
                                    <th>Position</th>
                                    <th>Batch</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($players as $p)
                                    <tr>
                                        <td>
                                            <i data-lucide="user" class="w-4 h-4 text-[#23234a]"></i> {{ $p->nama }}
                                        </td>
                                        <td>{{ $p->nomor }}</td>
                                        <td>{{ $p->umur }}</td>
                                        <td>
                                            <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-semibold text-xs">
                                                {{ $p->posisi }}
                                            </span>
                                        </td>
                                        <td>{{ $p->angkatan }}</td>
                                    </tr>
                                @empty
                                    <tr class="empty-row">
                                        <td colspan="5">No players found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Fun Formation Playground Card Besar, tinggi setara profile-panel -->
            <div class="feature-card w-full flex-1 flex flex-col items-center justify-between"
                style="min-height:0;height:100%;padding-top:2.5rem;padding-bottom:2.5rem;">
                <div class="feature-title mb-2">
                    <i data-lucide="layout" class="w-5 h-5"></i> Test Ur Gameplay
                </div>
                <div class="feature-desc mb-2 text-center w-full">
                    Seret titik-titik berwarna di lapangan untuk mengatur gameplay favoritmu! <span class="text-xs text-blue-500">(Tidak akan tersimpan, hanya untuk seru-seruan)</span>
                </div>
                <div class="w-full flex justify-center items-center flex-1">
                    <div class="relative bg-[#e0e7ef] rounded-xl border shadow flex items-center justify-center mx-auto"
                        style="width:500px; height:300px; min-width:300px; min-height:180px;">
                        <img src="{{ asset('images/lapangan.png') }}" alt="Futsal Field"
                            class="absolute top-0 left-0 w-full h-full object-cover rounded-xl pointer-events-none select-none" draggable="false">
                        @php
                            // Tim sendiri: GK-1-2-1 (kiri lapangan, 1 DF, 2 MF, 1 FW)
                            $dotColors = ['bg-yellow-400', 'bg-green-400', 'bg-blue-400', 'bg-pink-400', 'bg-purple-400'];
                            $dotLabels = ['GK', 'A', 'B', 'C', 'D'];
                            $defaultFormation = [
                                ['x'=>40,  'y'=>130],  // GK (kiri)
                                ['x'=>120, 'y'=>130],  // DF (tengah belakang)
                                ['x'=>220, 'y'=>80],   // MF1 (atas tengah)
                                ['x'=>220, 'y'=>180],  // MF2 (bawah tengah)
                                ['x'=>320, 'y'=>130],  // FW (paling depan)
                            ];
                            // Musuh: GK-2-2 (kanan lapangan, 2 DF, 2 FW)
                            $enemyFormation = [
                                ['x'=>440, 'y'=>130],  // GK (kanan)
                                ['x'=>360, 'y'=>80],   // DF1 (atas)
                                ['x'=>360, 'y'=>180],  // DF2 (bawah)
                                ['x'=>280, 'y'=>80],   // FW1 (atas)
                                ['x'=>280, 'y'=>180],  // FW2 (bawah)
                            ];
                        @endphp
                        <div id="funFormationDots" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            {{-- Tim sendiri (draggable, besar, kiri) --}}
                            @foreach($defaultFormation as $i => $pos)
                                <div class="draggable-dot"
                                    data-index="{{ $i }}"
                                    data-type="ally"
                                    style="position:absolute;left:{{ $pos['x'] }}px;top:{{ $pos['y'] }}px;width:36px;height:36px;z-index:2;cursor:grab;transition: box-shadow 0.2s;">
                                    <div class="w-9 h-9 rounded-full shadow-lg border-2 border-white flex items-center justify-center text-xs font-bold text-white {{ $dotColors[$i] }}"
                                         style="pointer-events:none;user-select:none;">
                                        <span style="pointer-events:none;user-select:none;">{{ $dotLabels[$i] }}</span>
                                    </div>
                                </div>
                            @endforeach
                            {{-- Musuh (draggable, kecil, kanan) --}}
                            @foreach($enemyFormation as $i => $pos)
                                <div class="draggable-dot"
                                    data-index="{{ $i }}"
                                    data-type="enemy"
                                    style="position:absolute;left:{{ $pos['x']+6 }}px;top:{{ $pos['y']+6 }}px;width:24px;height:24px;z-index:1;cursor:grab;transition: box-shadow 0.2s;">
                                    <div class="w-6 h-6 rounded-full shadow border-2 border-white flex items-center justify-center text-xs font-bold text-white bg-red-500"
                                         style="pointer-events:none;user-select:none;">
                                        {{-- kosong/tanpa label --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Profile Team & Photo -->
    <div id="profileModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 shadow-2xl w-full max-w-lg relative flex flex-col items-center">
            <button type="button" id="closeProfileModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            <form method="POST" action="{{ route('profil.tim.edit') }}" enctype="multipart/form-data" class="w-full max-w-xs flex flex-col items-center gap-4">
                @csrf
                <h3 class="text-xl font-bold mb-2 text-gray-800 flex items-center gap-2">
                    <i data-lucide="edit" class="w-5 h-5"></i> Edit Team Profile
                </h3>
                <div class="flex flex-col items-center gap-3 w-full">
                    <img id="profilePreview" src="{{ $user && $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/default-team.png') }}"
                        class="w-24 h-24 rounded-full object-cover border-2 border-navy bg-white"
                        alt="Team Profile Photo">
                    <input type="file" name="foto_profil" id="fotoProfilInput" accept="image/*"
                        class="w-full border rounded-md px-3 py-2 bg-gray-100 text-gray-800 mt-2">
                </div>
                <!-- Cropper Modal -->
                <div id="cropperModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
                    <div class="bg-white rounded-2xl p-6 shadow-2xl flex flex-col items-center max-w-md w-full relative">
                        <button type="button" id="closeCropperModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                        <div class="w-64 h-64 bg-gray-100 flex items-center justify-center overflow-hidden rounded-xl mb-4">
                            <img id="cropperImage" src="" class="max-w-full max-h-full" style="display:none;">
                        </div>
                        <button type="button" id="cropAndSave" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">Save Photo</button>
                    </div>
                </div>
                <!-- End Cropper Modal -->
                <div class="w-full flex flex-col gap-3 mt-2">
                    <div>
                        <label class="block text-gray-600 mb-1">Team Name</label>
                        <input name="nama_tim" type="text" value="{{ $user->name }}"
                            class="w-full border rounded-md px-3 py-2 bg-white text-gray-800 text-base"
                            placeholder="Enter team name"
                            required maxlength="15">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Team Email</label>
                        <input name="email" type="email" value="{{ $user->email }}"
                            class="w-full border rounded-md px-3 py-2 bg-white text-gray-800 text-base" placeholder="Team email"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Phone Number</label>
                        <input name="phone" type="text" value="{{ $user->phone }}"
                            class="w-full border rounded-md px-3 py-2 bg-white text-gray-800 text-base" placeholder="Team phone number">
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Password</label>
                        <input name="password" type="password"
                            class="w-full border rounded-md px-3 py-2 bg-white text-gray-800 text-base"
                            placeholder="New password (leave blank if unchanged)">
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-4 w-full">
                    <button type="button" id="closeProfileModal2"
                        class="px-6 py-2 rounded bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-base">Cancel</button>
                    <button type="submit"
                        class="px-6 py-2 rounded bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-base"
                        style="min-width:120px;">
                        <span style="display:inline;">Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Add Player -->
    <div id="addPlayerModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 shadow-2xl w-full max-w-md relative flex flex-col items-center">
            <button type="button" id="closeAddPlayerModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            <form method="POST" action="{{ route('profil.storePlayer') }}" class="w-full flex flex-col items-center gap-4">
                @csrf
                <h3 class="text-xl font-bold mb-2 text-gray-800 flex items-center gap-2">
                    <i data-lucide="user-plus" class="w-5 h-5"></i> Add Player
                </h3>
                <div class="w-full flex flex-col gap-3">
                    <input name="nama" type="text" class="w-full border rounded-md px-3 py-2" placeholder="Nama Pemain" required>
                    <input name="nomor" type="number" class="w-full border rounded-md px-3 py-2" placeholder="Nomor Punggung" required>
                    <input name="umur" type="number" class="w-full border rounded-md px-3 py-2" placeholder="Umur" required>
                    <input name="angkatan" type="text" class="w-full border rounded-md px-3 py-2" placeholder="Angkatan" required>
                    <select name="posisi" class="w-full border rounded-md px-3 py-2" required>
                        <option value="">Pilih Posisi</option>
                        <option value="Kiper">Kiper</option>
                        <option value="Anchor">Anchor</option>
                        <option value="Pivot">Pivot</option>
                        <option value="Flank">Flank</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2 mt-4 w-full">
                    <button type="button" id="closeAddPlayerModal"
                        class="px-6 py-2 rounded bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition text-base">Cancel</button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-8 py-2 rounded-xl font-semibold hover:bg-blue-700 transition text-base shadow">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    lucide.createIcons();
    // Fun Formation Playground - drag & drop (not saved to DB)
    const field2 = document.getElementById('funFormationDots');
    let dragging2 = null, offsetX2 = 0, offsetY2 = 0, fieldRect2 = null, dotType = null;
    if (field2) {
        field2.querySelectorAll('.draggable-dot').forEach(dot => {
            dot.addEventListener('mousedown', function(e) {
                dragging2 = dot;
                fieldRect2 = field2.getBoundingClientRect();
                offsetX2 = e.clientX - dot.getBoundingClientRect().left;
                offsetY2 = e.clientY - dot.getBoundingClientRect().top;
                dotType = dot.getAttribute('data-type');
                dot.style.zIndex = 10;
                dot.style.boxShadow = "0 0 0 4px #6366f1";
                document.body.style.userSelect = 'none';
            });
        });
        document.addEventListener('mousemove', function(e) {
            if (!dragging2) return;
            let dotW = dragging2.offsetWidth, dotH = dragging2.offsetHeight;
            let x = e.clientX - fieldRect2.left - offsetX2;
            let y = e.clientY - fieldRect2.top - offsetY2;
            // Clamp to field
            x = Math.max(0, Math.min(x, fieldRect2.width-dotW));
            y = Math.max(0, Math.min(y, fieldRect2.height-dotH));
            dragging2.style.left = x + 'px';
            dragging2.style.top = y + 'px';
        });
        document.addEventListener('mouseup', function(e) {
            if (!dragging2) return;
            dragging2.style.zIndex = dragging2.getAttribute('data-type') === 'enemy' ? 1 : 2;
            dragging2.style.boxShadow = "";
            dragging2 = null;
            document.body.style.userSelect = '';
        });
    }
    // Modal Edit Profile
    const editBtn = document.getElementById('editProfileBtn');
    const modal = document.getElementById('profileModal');
    const close1 = document.getElementById('closeProfileModal');
    const close2 = document.getElementById('closeProfileModal2');
    if(editBtn && modal) {
        editBtn.onclick = () => { modal.classList.remove('hidden'); modal.classList.add('flex'); };
        if(close1) close1.onclick = () => { modal.classList.add('hidden'); modal.classList.remove('flex'); };
        if(close2) close2.onclick = () => { modal.classList.add('hidden'); modal.classList.remove('flex'); };
    }

    // Modal Add Player
    const addBtn = document.getElementById('showAddPlayerModal');
    const addModal = document.getElementById('addPlayerModal');
    const closeAddBtns = document.querySelectorAll('#closeAddPlayerModal');
    if(addBtn && addModal) {
        addBtn.onclick = () => { addModal.classList.remove('hidden'); addModal.classList.add('flex'); };
        closeAddBtns.forEach(btn => btn.onclick = () => { addModal.classList.add('hidden'); addModal.classList.remove('flex'); });
    }
    // Modal Full Squad List
    const viewMoreBtn = document.getElementById('viewMoreSquadBtn');
    const fullSquadModal = document.getElementById('fullSquadModal');
    const closeFullSquadModal = document.getElementById('closeFullSquadModal');
    if(viewMoreBtn && fullSquadModal) {
        viewMoreBtn.onclick = () => { fullSquadModal.classList.remove('hidden'); fullSquadModal.classList.add('flex'); };
        if(closeFullSquadModal) closeFullSquadModal.onclick = () => { fullSquadModal.classList.add('hidden'); fullSquadModal.classList.remove('flex'); };
    }
    // --- FOTO PROFIL CROP & PREVIEW ---
    let cropper = null;
    const fotoInput = document.getElementById('fotoProfilInput');
    const cropperModal = document.getElementById('cropperModal');
    const cropperImage = document.getElementById('cropperImage');
    const cropAndSaveBtn = document.getElementById('cropAndSave');
    const closeCropperModal = document.getElementById('closeCropperModal');
    const profilePreview = document.getElementById('profilePreview');
    const mainProfilePhoto = document.getElementById('mainProfilePhoto');

    if (fotoInput) {
        fotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                cropperImage.src = ev.target.result;
                cropperImage.style.display = 'block';
                cropperModal.classList.remove('hidden');
                cropperModal.classList.add('flex');
                if (cropper) cropper.destroy();
                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };
            reader.readAsDataURL(file);
        });
    }
    if (closeCropperModal) {
        closeCropperModal.onclick = function() {
            cropperModal.classList.add('hidden');
            cropperModal.classList.remove('flex');
            if (cropper) cropper.destroy();
        };
    }
    if (cropAndSaveBtn) {
        cropAndSaveBtn.onclick = function() {
            if (!cropper) return;
            cropper.getCroppedCanvas({ width: 400, height: 400 }).toBlob(function(blob) {
                // Preview di modal
                const url = URL.createObjectURL(blob);
                profilePreview.src = url;
                if (mainProfilePhoto) mainProfilePhoto.src = url;
                // Ganti file input dengan hasil crop
                const file = new File([blob], "profile.jpg", { type: "image/jpeg" });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fotoInput.files = dataTransfer.files;
                // Tutup modal cropper
                cropperModal.classList.add('hidden');
                cropperModal.classList.remove('flex');
                cropper.destroy();
            }, 'image/jpeg', 0.95);
        };
    }
});
</script>
@endsection