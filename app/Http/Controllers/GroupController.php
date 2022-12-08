<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Right;
use App\Models\RightUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class GroupController extends Controller
{

    public function index()
    {
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }


    public function create()
    {
        $rights = Right::all();
        $users = RightUser::all();
        return view('groups.create',
        ['rights' => $rights, 'users' => $users,]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $slug = Str::slug($request->name);
         $group = Group::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        if($request->naamselect){
            foreach($request->naamselect as $user){
                GroupUser::create([
                    'group_id' => $group->id,
                    'user_id' => $user,
                ]);
            }
        }
        return redirect('/groups')->with('success', 'Groep is success vol ingevoerd');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $rights = Right::all();
        $users = RightUser::all();
        $group = Group::findorFail($id);

        return view('groups.edit', compact('group'), ['rights' => $rights, 'users' => $users,]);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Group::where('id', $id)->update($validatedData);
        GroupUser::where('id', $id)->update($request->naamselect);
    }


    public function destroy($id)
    {
        $groups = Group::findorFail($id);
        $groups->delete();

        return redirect('/groups')->with('success', 'Groep succes vol verwijderd');
    }

    public function ajax(Request $request){
        $ajaxretrieve = User::whereHas('rights', function($query) use ($request){
            $query->where('id', $request->selectedright);
        })->get();
        return $ajaxretrieve;
    }
}
