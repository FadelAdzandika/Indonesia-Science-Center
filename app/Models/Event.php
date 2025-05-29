<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'thumbnail', // Jika Anda berencana menggunakan thumbnail
        'event_date',  // Contoh kolom tambahan
        // tambahkan kolom lain yang relevan
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_date' => 'date', // Contoh casting tipe data
    ];

    
    /**
     * Base directory for event uploads within the public/uploads path.
     */
    public static string $uploadDirectory = 'events';

    /**
     * Get the absolute path to the event upload directory.
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
