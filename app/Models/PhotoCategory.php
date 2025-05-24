<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini jika Anda menggunakan factory

class PhotoCategory extends Model
{
    use HasFactory; // Tambahkan ini jika Anda menggunakan factory

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Tidak ada yang perlu di-cast secara khusus untuk atribut saat ini,
        // tapi ini tempatnya jika ada (misalnya, boolean, date, dll.)
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Get the route key for the model.
     * Menggunakan 'slug' untuk route model binding.
     *
     * @return string
     */
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
