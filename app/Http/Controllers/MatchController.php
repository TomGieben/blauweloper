<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Match;
use App\Models\User;


class MatchController extends Controller
{
    public function index () {

        return view('matches.index');
    }

    public function create () {
        $eee = Match::with('matchUser')->get();
        dd($eee);
        return view('matches.create');
    }

    public function store () {
        return redirect(route('matches.index'));
    }

    public function show () {
        return view('matches.show');
    }

    public function edit () {
        return view('matches.edit');
    }

    public function update () {
        return redirect(route('matches.index'));
    }

    public function delete () {
        return redirect(route('matches.index'));
    }
}
