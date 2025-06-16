<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'skill_level', 'gaya_bermain', 'foto_tim'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
