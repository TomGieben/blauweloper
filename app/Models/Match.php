<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\MatchUser;

class Match extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['start_date', 'end_date'];
    private $dateformat = 'd-m-Y H:i';

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
    }
}
