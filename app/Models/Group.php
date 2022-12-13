<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

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
