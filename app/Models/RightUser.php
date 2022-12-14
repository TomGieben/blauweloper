<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'right_id',
        'user_id',
    ];

    public $timestamps = false;
}
