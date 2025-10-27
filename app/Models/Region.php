<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Region extends Model
{
    /**
     * Kolom yang bisa diisi mass-assignment
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image'
    ];

    /**
     * Auto-generate slug dari name
     */
    protected static function boot()
    {
        parent::boot();
        
        // Saat create region baru
        static::creating(function ($region) {
            if (empty($region->slug)) {
                $region->slug = Str::slug($region->name);
            }
        });
        
        // Saat update region
        static::updating(function ($region) {
            $region->slug = Str::slug($region->name);
        });
    }
}