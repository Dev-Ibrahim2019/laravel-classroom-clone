<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classroom\StoreClassroomRequest;
use App\Http\Requests\Classroom\UpdateClassroomRequest;
use App\Models\Classroom;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Renderable
    {
        $classrooms = Classroom::status('active')
            ->recent()
            ->get();

        return view('classroom.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Classroom $classroom)
    {
        return view('classroom.create', compact('classroom'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        try {
            // Handle file upload first
            $coverImagePath = null;
            if (request()->hasFile('cover_image')) {
                $file = request()->file('cover_image');
                $coverImagePath = Classroom::uploadcoverimage($file);
            }

            // Generate a random code
            $code = Str::random(8);


            // Validate the request
            $validated = $request->validated();

            // Add the extra fields to the validated data
            $validated['cover_image_path'] = $coverImagePath;
            $validated['code'] = $code;
            $validated['user_id'] = Auth::id();

            // Create the classroom
            Classroom::create($validated);

            flash()->success("{$validated['name']} classroom created successfully!");
            return to_route('classrooms.index');
        } catch (ValidationException $e) {
            // Flash all error messages
            foreach ($e->validator->errors()->all() as $error) {
                flash()->error($error);
            }
            return back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        return view('classroom.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        return view('classroom.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        try {
            $validated = $request->validated();

            if (request()->hasFile('cover_image')) {
                $file = request()->file('cover_image');
                $path = Classroom::uploadcoverimage($file);
                $validated['cover_image_path'] = $path;
            }

            $old = $classroom->cover_image_path;

            $classroom->update($validated);

            if ($old && $old != $classroom->cover_image_path) {
                Classroom::deleteCoverImage($old);
            }

            flash()->success('Classroom updated successfully!');
            return to_route('classrooms.show', $classroom);
        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                flash()->error($error);
            }
            return back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        flash()->info('classroom deleted successfully!');
        return redirect()->route('classrooms.index');
    }

    public function trashed()
    {
        $classrooms = Classroom::onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return view('classroom.trashed', compact('classrooms'));
    }

    public function restore($id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();

        return redirect()
            ->route('classrooms.index')
            ->with('success', 'Classroom restored!');
    }

    public function forceDelete($id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->forceDelete();

        Classroom::deleteCoverImage($classroom->cover_image_path);

        flash()->info('Deleted Permentally');
        return to_route('classrooms.trashed');
    }
}
