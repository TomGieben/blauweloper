<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Right;
use Illuminate\Validation\Rule;

class RightController extends Controller
{
    public function index() {
        $rights = Right::all();

        return view('rights.index', [
            'rights' => $rights,
        ]);
    }

    public function create() {
        return view('rights.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:rights|max:255',
        ]);

        $slug = Str::slug($validated['name']);

        Right::create([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);

        return redirect()->route('rights.index');
    }

    public function edit(Right $right) {
        return view('rights.edit', [
            'right' => $right,
        ]);
    }

    public function update(Request $request, Right $right) {
        $validated = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('rights')->ignore($right->id, 'id')
            ],
        ]);

        $slug = Str::slug($validated['name']);

        $right->update([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);

        return redirect()->route('rights.index');
    }

    public function destroy(Right $right) {
        $right->delete();

        return redirect()->route('rights.index');
    }
}
