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
}
