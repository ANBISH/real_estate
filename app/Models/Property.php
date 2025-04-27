<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'property_type_id',
        'status_id',
        'user_id',
        'price',
        'currency_id',
        'address',
        'latitude',
        'longitude',
        'size',
        'measurement',
        'approved',
        'approved_at',
        'description',
    ];

    protected static function boot() {
        parent::boot();

    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
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
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function convertPrice(string $toCurrencyId)
    {
        $toCurrency = Currency::find($toCurrencyId);

        if (!$toCurrency) {
            throw new \Exception('Currency not found');
        }

        $fromCurrency = $this->currency;

        if ($fromCurrency->id === $toCurrency->id) {
            return $this->price;
        }

        $priceInUAH = $this->price * $fromCurrency->rate_to_uah;

        return $priceInUAH / $toCurrency->rate_to_uah;
    }
}
