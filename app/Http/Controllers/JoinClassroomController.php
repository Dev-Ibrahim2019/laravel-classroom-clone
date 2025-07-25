<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Scopes\UserClassroomScope;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class JoinClassroomController extends Controller
{
    public function create($id)
    {
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)
            ->active()
            ->findOrFail($id);

        try {
            $this->exists($id, Auth::id());
        } catch (Exception $e) {
            return to_route('classrooms.show', $id);
        }

        return response()->view('classroom.join', ['classroom' => $classroom]);
    }

    public function store(Request $request, $id)
    {
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)
            ->active()->findOrFail($id);

        try {
            $this->exists($id, Auth::id());
        } catch (Exception $e) {
            return to_route('classrooms.show', $id);
        }

        $classroom->join(Auth::id(), $request->post('role', 'student'));

        return to_route('classrooms.show', $id);
    }

    protected function exists($classroom_id, $user_id)
    {
        $exists = DB::table('classroom_user')
            ->where('classroom_id', $classroom_id)
            ->where('user_id', $user_id)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'message' => 'You have already joined this classroom.',
            ]);
        }
    }
}
