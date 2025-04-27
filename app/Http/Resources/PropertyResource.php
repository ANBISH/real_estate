<?php

namespace App\Http\Resources;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $currencies = Currency::all();

        $prices = [];

        foreach ($currencies as $currency) {
            $prices[$currency->id] = [
                'currency' => $currency->name,
                'price' => $this->convertPrice($currency->id)
            ];
        }

        return [
            'id' => $this->id,
            'type' => [
                'id' => $this->type->id,
                'name' => $this->type->name,
            ],
            'price' => [
                'amount' => $this->price,
                'currency' => [
                    'id' => $this->currency->id,
                    'name' => $this->currency->name,
                ],
            ],
            'location' => [
                'address' => $this->address,
                'coordinates' => [
                    'latitude' => $this->latitude,
                    'longitude' => $this->longitude,
                ],
            ],
            'size' => [
                'value' => $this->size,
                'measurement' => $this->measurement ?? 'm²',
            ],
            'description' => $this->description,
            'status' => [
                'id' => $this->status->id,
                'name' => $this->status->name,
            ],
            'all_price' => $prices
        ];
    }
}
