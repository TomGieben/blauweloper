<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use App\Models\User;

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

    public static function generatePassword() {
        $random_password = str::random(12);
    
        return $random_password;
    }
    
    public function matches(): BelongsToMany {
        return $this->belongsToMany(Match::class, 'match_users', 'user_id', 'match_id')->withPivot('is_player', 'has_won', 'score');
    }

    public function rights(): BelongsToMany {
        return $this->belongsToMany(Right::class, 'right_users', 'user_id', 'right_id');
    }

    public function hasRight(array $rights = []): bool {
        foreach($rights as $right) {
            $right = Right::select('id')->where('slug', $right)->first();
            $user = $this;
    
            if($right) {
                $relation = RightUser::query()
                    ->where('user_id', $user->id)
                    ->where('right_id', $right->id)
                    ->exists();
            }
    
            if(!$right || !$relation) {
                return false;
            };
        }

        return true;
    }

    public function inGroup(string $group): bool {
        $group = Group::select('id')->where('slug', $group)->first();
        $user = $this;

        if($group) {
            $relation = GroupUser::query()
                ->where('user_id', $user->id)
                ->where('group_id', $group->id)
                ->exists();
        }

        return ($group ? $relation : false);
    }
    
}
