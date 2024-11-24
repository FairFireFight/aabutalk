<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Faculty;
use App\Models\Forum;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    function store(Request $request)
    {
        $attributes = $request->validate([
            'name_en' => ['required', 'string', 'unique:faculties,name_en'],
            'name_ar' => ['required', 'string', 'unique:faculties,name_ar'],
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        $faculty = Faculty::create($attributes);

        Board::create([
            'faculty_id' => $faculty->id,
            'user_ids' => Json::encode([Auth::user()->id]),
        ]);

        Forum::create([
            'faculty_id' => $faculty->id,
        ]);

        return redirect('/admin/dashboard/faculties/edit/' . $faculty->id);
    }

    function update(Request $request, Faculty $faculty)
    {
        $attributes = $request->validate([
            'name_en' => ['required', 'string', 'unique:faculties,name_en,'.$faculty->id],
            'name_ar' => ['required', 'string', 'unique:faculties,name_en,'.$faculty->id],
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        $faculty->name_en = $attributes['name_en'];
        $faculty->name_ar = $attributes['name_ar'];
        $faculty->description_en  = $attributes['description_en'];
        $faculty->description_ar  = $attributes['description_ar'];

        $faculty->save();

        return redirect('/admin/dashboard/faculties/edit/' . $faculty->id);
    }

    function destroy(Faculty $faculty) {
        // not allowed to delete faculty 0
        if ($faculty->id == 0) {
            return redirect('/admin/dashboard/faculties');
        }

        $faculty->delete();
        return redirect('/admin/dashboard/faculties');
    }
}
