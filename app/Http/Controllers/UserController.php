<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Right;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\RightUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {

        $users = User::all();

        return view('users.index', [
             'users' => $users,
        ]);
    }

    public function create()
    {
        $rights = Right::all();
        $groups = Group::all();

         return view('users.create', [ 
            'rights' => $rights,
            'groups' => $groups
         ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        if($request->rights) {
            foreach($request->rights as $right) {

                RightUser::create([
                    'right_id'=> $right,
                    'user_id' => $user->id,
                ]);
            }
        }

        if($request->groups) {
            foreach($request->groups as $group) {
                
                GroupUser::create([
                    'group_id'=> $group,
                    'user_id' => $user->id,
                ]);
            }

            return redirect()->route('users.index');
        }
    }

    public function edit(Request $request, User $user)
    {
        $rights = Right::all();
        $groups = Group::all();

         return view('users.edit', [ 
            'rights' => $rights,
            'groups' => $groups,
            'user' => $user,
         ]);
    }

    public function update(Request $request,User $user)
    {   

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        User::query()
            ->where('id', $user->id)
            ->update([
                'name'=> $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

        RightUser::query()
            ->where('user_id', $user->id)
            ->delete();

        GroupUser::query()
            ->where('user_id', $user->id)
            ->delete();

        if($request->rights) {
            foreach($request->rights as $right) {

                RightUser::create([
                    'right_id'=> $right,
                    'user_id' => $user->id,
                ]);
            }
        }

        if($request->groups) {
            foreach($request->groups as $group) {

                GroupUser::create([
                    'group_id'=> $group,
                    'user_id' => $user->id,
                ]);
            }
        }

        return redirect()->route('users.index');
    }

    public function destroy(user $user)
    {
        $user->delete();
        
        RightUser::query()
            ->where('user_id', $user->id)
            ->delete();

        GroupUser::query()
            ->where('user_id', $user->id)
            ->delete();

        return redirect()->route('users.index');
    }
}
