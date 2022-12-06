<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\MatchUser;

class Match extends Model
{
    use HasFactory, SoftDeletes;

    public function getRouteKeyName(){
        return 'slug';
    }

    public function matchUser() :HasMany
    {
        return $this->hasMany(MatchUser::class);
    }
}
