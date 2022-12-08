<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $datetime = date('Y-m-d h:i:s');
        $currentRights = $user->rights()->get();
        $currentMatches = User::query()
            ->where('id', $user->id)
            ->with('matches', function($query) use ($datetime) {
                $query->where('start_date', '>=', $datetime);
            })->first()->matches;

        $matchesWon = User::query()
            ->where('id', $user->id)
            ->with('matches', function($query) use ($datetime) {
                $query->where('has_won', true);
            })->first()->matches->count();

        return view('home', [
            'currentRights' => $currentRights,
            'currentMatches' => $currentMatches,
            'matchesWon' => $matchesWon,
        ]);
    }
}
