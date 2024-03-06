<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Course::all()
        ]);
    }

    public function store(CourseRequest $request)
    {
        return response()->json([
            'data' => Course::create($request->all())
        ], 201);
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->all());

        return response()->json(['data' => $course]);
    }
}
