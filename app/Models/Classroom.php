<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use App\Observers\ClassroomObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    public static string $disk = 'public';

    protected $fillable = [
        'name',
        'section',
        'subject',
        'room',
        'theme',
        'cover_image_path',
        'code',
        'user_id'
    ];

    public static function booted()
    {
        static::observe(ClassroomObserver::class);
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

    public function join($user_id, $role = 'student')
    {
        return DB::table('classroom_user')->insertOrIgnore([
            'classroom_id' => $this->id,
            'user_id' => $user_id,
            'role' => $role,
            'created_at' => now()
        ]);
    }

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function CoverImagePath(): Attribute
    {
        return Attribute::make(
            get: fn($value) =>
            $value ? "storage/$value" : "https://placehold.co/400x300?text=Classroom+Image"
        );
    }

    public function getUrlAttribute()
    {
        return route('classrooms.show', $this->id);
    }

    public function InvitationLink(): Attribute
    {
        return Attribute::make(
            get: fn() => URL::signedRoute('classrooms.join', [
                'classroom' => $this->id,
                'code' => $this->code
            ])
        );
    }
}
