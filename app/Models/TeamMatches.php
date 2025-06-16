<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TeamMatches extends Model
{
    protected $table = 'team_matches'; // Sudah benar

    protected $fillable = ['team1_id', 'team2_id'];

    // Relasi HARUS ke User, bukan ke Team
    public function team1()
    {
        return $this->belongsTo(User::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(User::class, 'team2_id');
    }
}
