<?php

namespace App\Http\Controllers;

use App\Http\Requests\Classroom\StoreClassroomRequest;
use App\Http\Requests\Classroom\UpdateClassroomRequest;
use App\Models\Classroom;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $validated = $request->validated();

        if (request()->hasFile('cover_image')) {
            $file = request()->file('cover_image');
            $validated['cover_image_path'] = Classroom::uploadcoverimage($file);
        }

        DB::beginTransaction();

        try {
            $classroom = Classroom::create($validated);

            $classroom->join(Auth::id(), 'teacher');

            DB::commit();

            flash()->success("{$classroom->name} classroom created successfully!");
            return to_route('classrooms.index');
        } catch (\Throwable $e) {
            DB::rollBack();

            flash()->error('Failed to create classroom: ' . $e->getMessage());
            return back()->withInput();
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

        flash()->info('Deleted Permentally');
        return to_route('classrooms.trashed');
    }
}
