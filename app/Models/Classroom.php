<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Classroom extends Model
{
    use HasFactory;

    public static string $disk = 'public';

    protected $fillable = ['name', 'section', 'subject', 'room', 'cover_image_path', 'code'];

    public static function uploadCoverImage($file)
    {
        return $file->store('/covers', [
            'disk' => static::$disk
        ]);
    }

    public static function deleteCoverImage($file)
    {
        return Storage::disk(static::$disk)->delete($file);
    }
}
