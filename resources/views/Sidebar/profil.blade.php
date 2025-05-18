@extends('Sidebar.sidebar')

@section('content')
    <div class="p-4">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Next Match --}}
        <div class="bg-white rounded-xl shadow-md p-6 mb-6 border-l-4 border-cyan-500">
            <h3 class="text-xl font-semibold mb-3 text-gray-800 flex items-center gap-2">
                📅 Next Match
            </h3>
            <ul class="space-y-1 text-gray-700">
                <li><strong>Lapangan:</strong> Lapangan Futsal ABC</li>
                <li><strong>Hari:</strong> Minggu</li>
                <li><strong>Tanggal:</strong> 19 Mei 2025</li>
                <li><strong>Jam:</strong> 20:30 WIB</li>
            </ul>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-200">
                <h3 class="text-sm text-gray-500 mb-1">Total Matches</h3>
                <p class="text-3xl font-bold text-cyan-600">25</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-200">
                <h3 class="text-sm text-gray-500 mb-1">Squad Size</h3>
                <p class="text-3xl font-bold text-cyan-600">{{ count($players) }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-200">
                <h3 class="text-sm text-gray-500 mb-1">Avg Age</h3>
                <p class="text-3xl font-bold text-cyan-600">{{ number_format($players->avg('umur'), 1) }}</p>
            </div>
        </div>

        {{-- Squad Table --}}
        <div class="overflow-x-auto bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold mb-3 text-gray-800">🧑‍🤝‍🧑 Squad</h2>
            <table class="table-auto w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Nomor</th>
                        <th class="px-4 py-2">Umur</th>
                        <th class="px-4 py-2">Jurusan</th>
                        <th class="px-4 py-2">B..</th>
                        <th class="px-4 py-2">Gol</th>
                        <th class="px-4 py-2">Assist</th>
                        <th class="px-4 py-2">Clean Sheet</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($players as $player)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $player->nama }}</td>
                            <td class="px-4 py-2">{{ $player->nomor }}</td>
                            <td class="px-4 py-2">{{ $player->umur }}</td>
                            <td class="px-4 py-2">{{ $player->jurusan }}</td>
                            <td class="px-4 py-2">{{ $player->angkatan }}</td>
                            <td class="px-4 py-2">{{ $player->gol }}</td>
                            <td class="px-4 py-2">{{ $player->assist }}</td>
                            <td class="px-4 py-2">{{ $player->clean_sheet }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tambah Pemain --}}
        <form action="{{ route('profil.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" required class="w-full border p-2 rounded"
                        placeholder="Masukkan nama">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Punggung</label>
                    <input type="number" name="nomor" required class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Umur</label>
                    <input type="number" name="umur" required class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan</label>
                    <input type="text" name="jurusan" required class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Angkatan (B..)</label>
                    <input type="text" name="angkatan" required placeholder="Contoh: B27"
                        class="w-full border p-2 rounded">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white font-medium px-6 py-2 rounded-xl shadow-md transition-all duration-300 hover:scale-105">
                    ➕ Tambah Pemain
                </button>
            </div>
        </form>
    </div>
@endsection
