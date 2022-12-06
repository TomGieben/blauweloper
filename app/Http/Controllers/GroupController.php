<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function index()
    {
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }


    public function create()
    {
        return view('groups.create');
    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {

    }
}
