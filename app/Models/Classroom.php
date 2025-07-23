<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    public static string $disk = 'public';

    protected $fillable = [
        'name', 'section', 'subject', 'room', 'theme', 'cover_image_path',
        'code', 'user_id'
    ];

    public static function booted()
    {
        static::addGlobalScope(UserClassroomScope::class);
    }

    public static function uploadCoverImage($file)
    {
        return $file->store('/covers', [
            'disk' => static::$disk
        ]);
    }

    public static function deleteCoverImage($path)
    {
        if (!$path || !Storage::disk(static::$disk)->exists($path))
            return;

        return Storage::disk(static::$disk)->delete($path);
    }

    public function scopeActive(Builder $query)
    {
        $query->where('status', 'active');
    }

    public function scopeRecent(Builder $query)
    {
        $query->orderBy('updated_at', 'DESC');
    }

    public function scopeStatus(Builder $query, $status)
    {
        $query->where('status', $status);
    }
}
