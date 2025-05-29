<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_category_id',
        'title',
        'image_path',
        'description',
    ];

    public function photoCategory()
    {
        return $this->belongsTo(PhotoCategory::class);
    }
        /**
     * Base directory for photo uploads within the public/uploads path.
     */
    public static string $uploadDirectory = 'gallery_photos'; // atau 'photos' sesuai preferensi Anda

    /**
     * Get the absolute path to the photo upload directory.
     *
     * @return string
     */
    public static function getUploadPath(): string
    {
        // Menggunakan public_path() yang mungkin sudah di-override di AppServiceProvider
        return public_path('uploads/' . self::$uploadDirectory);
    }

    /**
     * Get the relative path for storing in the database.
     *
     * @param string $filename
     * @return string
     */
    public static function getRelativePath(string $filename): string
    {
        return self::$uploadDirectory . '/' . $filename;
    }

    // Anda bisa menambahkan accessor getImageUrlAttribute jika diperlukan
    // seperti pada model Wahana
}
