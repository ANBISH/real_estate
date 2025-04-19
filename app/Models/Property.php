<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'status_id',
        'user_id',
        'price_amount',
        'price_currency_id',
        'address',
        'latitude',
        'longitude',
        'size_value',
        'size_measurement',
        'description',
    ];

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'type_id');
    }

    public function status()
    {
        return $this->belongsTo(PropertyStatus::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'price_currency_id');
    }
}
