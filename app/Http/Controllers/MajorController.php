<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    function store(Request $request) {
        $attributes = $request->validate([
            'id' => ['required', 'max:999', 'min:100', 'numeric', 'unique:majors,id'],
            'title_en' => ['required', 'string'],
            'title_ar' => ['required', 'string'],
        ]);

        Major::create($attributes);

        return redirect()->back();
    }

    function update(Request $request, Major $major) {
        $attributes = $request->validate([
            'id' => ['required', 'max:999', 'min:100', 'numeric', 'unique:majors,id,' . $major->id],
            'title_en' => ['required', 'string'],
            'title_ar' => ['required', 'string'],
        ]);

        $major->id = $attributes['id'];
        $major->title_en = $attributes['title_en'];
        $major->title_ar = $attributes['title_ar'];

        $major->save();

        return redirect()->back();
    }

    function destroy(Major $major) {
        $major->delete();
        return redirect()->back();
    }
}
