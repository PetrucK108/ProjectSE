<?php

namespace App\Data;

class LapanganData
{
    public static function all()
    {
        return [
            [
                'nama' => 'Elang Futsal',
                'lokasi' => 'West Jakarta',
                'harga' => 'Rp. 250.000,00/hour',
                'gambar' => asset('images/lapangan/lapangan1.jpg'),
                'link' => 'https://goo.gl/maps/elangfutsal'
            ],
            [
                'nama' => 'Indo Futsal',
                'lokasi' => 'West Jakarta',
                'harga' => 'Rp. 200.000,00/hour',
                'gambar' => asset('images/lapangan/lapangan2.jpg'),
                'link' => 'https://goo.gl/maps/indofutsal'
            ],
            [
                'nama' => 'Terminal Futsal',
                'lokasi' => 'West Jakarta',
                'harga' => 'Rp. 220.000,00/hour',
                'gambar' => asset('images/lapangan/lapangan3.jpg'),
                'link' => 'https://goo.gl/maps/terminalfutsal'
            ],
            [
                'nama' => 'Champion Futsal',
                'lokasi' => 'West Jakarta',
                'harga' => 'Rp. 250.000,00/hour',
                'gambar' => asset('images/lapangan/lapangan4.jpg'),
                'link' => 'https://goo.gl/maps/championfutsal'
            ],
            // Tambahkan data lapangan baru di sini jika perlu
        ];
    }
}
