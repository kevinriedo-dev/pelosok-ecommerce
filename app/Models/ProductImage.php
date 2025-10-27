<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /**
     * Kolom yang bisa diisi
     */
    protected $fillable = [
        'product_id',
        'image_path',
        'is_primary',
        'order'
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Relationship: Image belongs to Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}