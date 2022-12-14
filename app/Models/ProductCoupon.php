<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
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

    public function discount($total)
    {
        if (!$this->checkDate() || !$this->checkUsedTimes()) {
            return 0;
        }
        return $this->checkGreaterThan($total) ? $this->doProcess($total) : 0;
    }

    protected function checkDate()
    {
        return $this->expire_date != '' ? Carbon::now()->between($this->start_date, $this->expire_date, true) ? true : false : true;
    }

    protected function checkUsedTimes()
    {
        return $this->use_times != '' ? ($this->use_times > $this->used_times) ? true : false : true;
    }

    protected function checkGreaterThan($total)
    {
        return $this->greater_than != '' ? ($total >= $this->greater_than) ? true : false : true;
    }

    protected function doProcess($total)
    {
        switch ($this->type) {
            case 'fixed':
                return $this->value;
            case 'percentage':
                return ($this->value / 100) * $total;
            default:
                return 0;
        }
    }


}
