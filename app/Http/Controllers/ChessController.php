<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chess;

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
    }

    public function update(Request $request) {

        
    }

    public function delete(Chess $chess) {
        $chess->delete();

        return redirect()->route('home');
    }
}
