<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function rights(): BelongsToMany
    {
        return $this->belongsToMany(RightUser::class, 'right_id', 'user_id',);
    }
}
