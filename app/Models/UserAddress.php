<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Nicolaslopezj\Searchable\SearchableTrait;

class UserAddress extends Model
{
    use HasFactory, SearchableTrait;

    public $searchable = [
        'columns' => [
            'user_adresses.address_title' => 10,
            'user_adresses.first_name' => 10,
            'user_adresses.last_name' => 10,
            'user_adresses.email' => 10,
            'user_adresses.mobile' => 10,
            'user_adresses.address' => 10,
            'user_adresses.address2' => 10,
            'user_adresses.zip_code' => 10,
            'user_adresses.po_box' => 10,
            'countries.name' => 10,
            'states.name' => 10,
            'cities.name' => 10,
            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.username' => 10,
            'users.email' => 10,
            'users.mobile' => 10,
        ],
        'joins' => [
            'users' => [ 'users.id', 'user_addresses.user_id' ],
            'countries' => [ 'countries.id', 'user_addresses.country_id' ],
            'states' => [ 'countries.id', 'user_addresses.state_id' ],
            'cities' => [ 'countries.id', 'user_addresses.city_id' ],
        ]
    ];
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function defaultAddress(): ?string
    {
        return $this->default_address ? 'Default Address' : null;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
