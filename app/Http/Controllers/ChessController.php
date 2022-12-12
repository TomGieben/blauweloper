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
}
