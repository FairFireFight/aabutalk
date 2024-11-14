<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Faculty;
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

        return redirect('/admin/dashboard/faculties/edit/' . $faculty->id);
    }

    function update(Request $request, Faculty $faculty)
    {
        $attributes = $request->validate([
            'name_en' => ['required', 'string', 'unique:faculties,name_en'],
            'name_ar' => ['required', 'string', 'unique:faculties,name_ar'],
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        $faculty = Faculty::create($attributes);

        return redirect('/admin/dashboard/faculties/edit/' . $faculty->id);
    }
}
