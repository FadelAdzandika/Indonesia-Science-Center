<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wahana extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'color',
        'image',
        'video_embed_url',
        'is_new',
    ];

    protected $casts = [
        'is_new' => 'boolean',
    ];

    /**
     * Base directory for wahana uploads within the public/uploads path.
     */
    public static string $uploadDirectory = 'wahanas';

    /**
     * Get the absolute path to the wahana upload directory.
     *
     * @return string
     */
    public static function getUploadPath(): string
    {
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

    /**
     * Get the full public URL for the image.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('uploads/' . $this->image);
        }
        return null;
    }
}
