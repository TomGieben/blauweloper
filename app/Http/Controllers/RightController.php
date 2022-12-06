<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Right;

class RightController extends Controller
{
    public function index() {
        $rights = Right::all();

        return view('rights.index', [
            'rights' => $rights,
        ]);
    }

    public function create() {

    }

    public function store() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function delete() {

    }
}
