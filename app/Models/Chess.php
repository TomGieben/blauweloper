<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class Chess extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'body',
    ];

    private int $tiles = 64;
    private int $rows = 8;
    private int $colums = 8;
    private int $tileWidth = 75;
    private int $tileHeight = 75;
    private int $border = 1;

    private function getTile(string $color = 'white', int $y, int $x): HtmlString {

        $htmlTile = '<div style="height: '.$this->tileHeight.'px; width: '.$this->tileWidth.'px; background-color: '.$color.'; float: left;" data-y="'. $y .'" data-x="'. $x .'" data-color="'. $color .'"class="tile d-flex justify-content-center align-items-center"></div>';

        return new HtmlString($htmlTile);
    }

    public function getBoard(): HtmlString {
        if(request()->ai == "true") {
            if(auth()->user()->chesses()->first()) {
                $html = auth()->user()->chesses()->first()->body;
            } else {
                $html = $this->createBoard();
            }
        } else {
            $datetime = date('Y-m-d h:i:s');
            
            $match = User::query()
                ->where('id', auth()->user()->id)
                ->with('matches', function($query) use ($datetime) {
                    $query->where('start_date', '>=', $datetime);
                })
                ->first()
                ->matches[0] ?? null;

            if($match->body) {
                $html = $match->body;
            } else {
                $html = $this->createBoard();
            }
        }

        return new HtmlString($html);
    }

    private function createBoard(): HtmlString {
        $boardHeight = $this->rows * $this->tileHeight;
        $boardWidth = $this->colums * $this->tileWidth;

        $html = '<div style="height: '.($boardHeight + ($this->border * 2)).'px; width: '.($boardWidth + ($this->border * 2)).'px; border: '. $this->border .'px solid black;">';
            for($r = 1; $r <= $this->rows; $r++) {
                for($c = 1; $c <= $this->colums; $c++) {
                    $total = $r + $c;
                    if($total % 2 == 0) {
                        $html .= $this->getTile('white', $r, $c);
                    }else {
                        $html .= $this->getTile('black', $r, $c);
                    }
                }
            }
        $html .= '</div>';

        return new HtmlString($html);
    }
}
