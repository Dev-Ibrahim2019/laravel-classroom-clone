<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserClassroomScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if ($id = Auth::id()) {
            $builder->where('user_id', $id)
                ->orWhereExists(function ($query) use ($id) {
                    $query->select(DB::raw('1'))
                        ->from('classroom_user')
                        ->whereColumn('classroom_id', 'classrooms.id')
                        ->where('user_id', $id);
                });

            // $builder->where('user_id', $id)
            //     ->orWhereRaw('
            //         EXISTS (SELECT 1 FROM classroom_user
            //         WHERE classroom_id = classrooms.id
            //         AND user_id = ?)
            //     ', [$id]);
        }
    }

    /**
     * SELECT * FROM classrooms
     * WHERE user_id = ?
     * OR classrooms.id IN (
     *  SELECT classroom_id FROM classroom_user
     *  WHERE user_id = ?
     * )
     *
     *
     * Here I can repalce IN(...) with EXISTS()
     * to obtain more performance like that:
     *
     * OR Classrooms.id EXISTS(
     *  SELECT 1 FROM classroom_user
     *  WHERE classroom_id = classrooms.id
     *  AND user_id = ?
     * )
     */
}
