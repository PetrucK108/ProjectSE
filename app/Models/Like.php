<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'liked_user_id', // atau 'team_id' tergantung implementasimu
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
