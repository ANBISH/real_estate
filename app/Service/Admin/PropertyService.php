<?php

namespace App\Service\Admin;

use App\Models\Property;

class PropertyService
{
    public function list()
    {
        return Property::paginate(10);
    }

    public function updateProperty(Property $property, array $data)
    {
        $property->update($data);

        return $property;
    }
}
