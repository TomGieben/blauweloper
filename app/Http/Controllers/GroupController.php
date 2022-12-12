<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Right;
use App\Models\RightUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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


    public function edit(Request $request, $id)
    {
        $rights = Right::all();
        $users = User::all();
        $group = Group::findorFail($id);

        return view('groups.edit', [
            'name' => $request->name,
            'rights' => $rights,
            'users' => $users,
            'group' => $group,
        ]);
    }


    public function update(Request $request, $id)
    {
        $groupdata = $request->validate([
            'name' => ['required'],

        ]);

        GroupUser::query()
            ->where('group_id', $id)
            ->delete();

            if($request->naamselect) {
                foreach($request->naamselect as $user) {

                    GroupUser::create([
                        'group_id'=> $id,
                        'user_id' => $user,
                    ]);
                }
            }

        Group::where('id', $id)->update($groupdata);
       return redirect('/groups')->with('success', 'groep succes vol aangepast');
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
