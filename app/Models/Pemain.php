<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    use HasFactory;

    protected $table = 'pemain';

    protected $fillable = [
        'user_id',
        'nama',
        'nomor',
        'umur',
        'jurusan',
        'angkatan',
        'posisi',
        'gol',
        'assist',
        'goals_conceded',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
