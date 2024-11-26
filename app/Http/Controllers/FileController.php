<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class FileController extends Controller
{
    function store(Request $request) {
        $file = $request->file('image');

        if ($file) {
            $path = $file->store('/images/uploads', ['disk' => 'public']);

            return Json::encode(['path' => asset($path)]);
        }

        return response(status: 400);
    }
}
