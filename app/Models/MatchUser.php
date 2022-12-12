<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'user_id',
        'is_player',
        'has_won',
        'score',
    ];
}
