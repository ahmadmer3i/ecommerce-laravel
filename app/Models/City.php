<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class City extends Model
{
    use HasFactory, SearchableTrait;

    public $timestamps = false;
    public $searchable = [
        'columns' => [
            'cities.name' => 10,
        ]
    ];
    protected $guarded = [];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function status(): string
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }
}
