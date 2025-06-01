<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preference extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'team_id', 'status'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
