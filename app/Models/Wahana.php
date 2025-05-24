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
        'is_new',
    ];

    protected $casts = [
        'is_new' => 'boolean', // Pastikan is_new selalu dianggap sebagai boolean
    ];
}