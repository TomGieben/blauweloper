<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chess;
use App\Models\User;

class ChessController extends Controller
{
    public function index() {
        $chess = new Chess;
        $board = $chess->getBoard();

        return view('chesses.index', [
            'board' => $board,
        ]);
    }

    public function store(Request $request) {
        if($request->ai == 'true') {
            $board = auth()->user()->chesses()->first();

            if($board) {
                $board->update([
                    'body' => $request->body
                ]);
            } else {
                Chess::create([
                    'user_id' => auth()->user()->id,
                    'body' => $request->body
                ]);
            }
        }else {
            $datetime = date('Y-m-d h:i:s');

            $match = User::query()
                ->where('id', auth()->user()->id)
                ->with('matches', function($query) use ($datetime) {
                    $query->where('start_date', '>=', $datetime);
                })
                ->first()
                ->matches[0] ?? null;

            if($match) {
                $match->update([
                    'body' => $request->body
                ]);
            }
        }
    }

    public function update() {
        $datetime = date('Y-m-d h:i:s');

        $match = User::query()
            ->where('id', auth()->user()->id)
            ->with('matches', function($query) use ($datetime) {
                $query->where('start_date', '>=', $datetime);
            })
            ->first()
            ->matches[0] ?? null;

        if($match) {
            $html = $match->body;
        } 
        
        return $html ?? "";
    }

    public function delete(Chess $chess) {
        $chess->delete();

        return redirect()->route('home');
    }
}
