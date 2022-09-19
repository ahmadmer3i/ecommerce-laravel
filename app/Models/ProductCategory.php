<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductCategory extends Model
{
    use HasFactory, Sluggable, SearchableTrait;

    protected $guarded = [];
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'product_categories.name' => 10,
        ],
    ];

    public static function tree($level = 1)
    {
        return static::with(implode('.', array_fill(0, $level, 'children')))
            ->whereNull('parent_id')
            ->whereStatus(true)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function status()
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }

    public function appearedChildren(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id')->where('status', true);
    }
}
