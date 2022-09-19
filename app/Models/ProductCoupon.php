<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProductCoupon extends Model
{
    use HasFactory, SearchableTrait;

    protected $guarded = [];
    protected $dates = [ 'start_date', 'expire_date' ];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'product_coupons.code' => 10,
            'product_coupons.description' => 10,
        ],
    ];

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }
}
