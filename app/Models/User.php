<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(Match::class, 'match_users', 'user_id', 'match_id')->withPivot('is_player', 'has_won', 'score');
    }

    public function rights(): BelongsToMany
    {
        return $this->belongsToMany(Right::class, 'right_users', 'user_id', 'right_id');
    }

    public function hasRight(string $right): bool {
        $right = Right::select('id')->where('slug', $right)->first();
        $user = auth()->user();

        if($right) {
            $relation = RightUser::query()
                ->where('user_id', $user->id)
                ->where('right_id', $right->id)
                ->exists();
        }

        return ($right ? $relation : false);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_users', 'group_id', 'user_id');
    }
}
