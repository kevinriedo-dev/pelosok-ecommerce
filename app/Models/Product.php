<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /**
     * Kolom yang bisa diisi
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'region_id',
        'category_id',
        'material',
        'size_info',
        'care_instructions',
        'is_active'
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
        
        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    /**
     * Relationship: Product belongs to Region
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Relationship: Product belongs to Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship: Product has many Images
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    /**
     * Get primary image
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }
}