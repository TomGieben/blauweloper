<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\MatchUser;
use App\Models\User;

class Match extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['start_date', 'end_date'];
    private $dateformat = 'd-m-Y H:i';
    protected $fillable = [
        'name',
        'slug',
        'start_date',
        'end_date',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function getStartDate(): string {
        return $this
        ->start_date
        ->format(
            $this->dateformat
        );
    }

    public function getEndDate(): string {
        return $this
        ->end_date
        ->format(
            $this->dateformat
        );
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'match_users', 'match_id', 'user_id')->withPivot('is_player', 'has_won', 'score', 'created_at', 'updated_at');
    }

    public function getCoach(): User{
        $users = $this->users()->get();

        foreach($users as $user) {
            if(!$user->pivot->is_player){
                return $user;
            }
        }
    }
}
