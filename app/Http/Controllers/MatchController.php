<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Match;
use App\Models\MatchUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class MatchController extends Controller
{
    public function index () {
        $matches = Match::with('users')->get();
        
        return view('matches.index', [
            'matches' => $matches,
        ]);
    }

    public function create () {
        $users = User::all();
        $coaches = User::whereHas('rights', function($query) {
            $query->where('slug', 'scheidsrechter');
        })->get();

        return view('matches.create', [
            'users' => $users,
            'coaches' => $coaches,
        ]);
    }

    public function store (Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:matches,name',
            'date' => 'required',
            'player1' => 'required',
            'player2' => 'required',
            'coach' => 'required',
        ]);

        $match = Match::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'start_date' => $validated['date'],
        ]);

        MatchUser::create([
            'match_id' => $match->id,
            'user_id' => $validated['coach'],
            'is_player' => false,
        ]);

        for($i=1; $i<3; $i++){
            MatchUser::create([
                'match_id' => $match->id,
                'user_id' => $validated['player'.strval($i)],
                'is_player' => true,
            ]);
        };

        return redirect(route('matches.index'));
    }

    public function show () {
        return view('matches.show');
    }

    public function edit (Request $request, Match $match) {
        return view('matches.edit', [
            'match' => $match
        ]);
    }

    public function update () {
        return redirect(route('matches.index'));
    }

    public function delete () {
        return redirect(route('matches.index'));
    }
}
