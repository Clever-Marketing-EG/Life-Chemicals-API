<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'description_ar',
        'image_url',
        'uses',
        'uses_ar',
        'origins',
        'origins_ar',
        'weight'
    ];

    protected $casts = [
        'origins' => 'array',
        'origins_ar' => 'array'
    ];

    /**
     * relates to Category
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }


    /**
     * Returns the categories this product belongs to
     *
     * @return Product
     */
    public function getCategories(): Product
    {
        return $this->load('categories:id,name,name_ar');
    }
}
