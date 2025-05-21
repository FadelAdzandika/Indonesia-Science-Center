<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi mass assignment
    protected $fillable = ['name', 'date', 'image'];
}
