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
        'image', // Kolom gambar yang sudah ada
        'is_new',
        'video_embed_url', // Tambahkan ini
    ];
}
