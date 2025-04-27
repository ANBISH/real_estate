<?php

namespace App\Service;

use App\Models\Property;

class PropertyService
{
    public function listUserProperties($user)
    {
        return $user->properties()->paginate(10);
    }

    public function createProperty($user, array $data)
    {
        return $user->properties()->create($data);
    }

    public function updateProperty(Property $property, array $data)
    {
        $property->update($data);

        return $property;
    }

    public function deleteProperty(Property $property)
    {
        return $property->delete();
    }

    public function authorizeProperty($user, Property $property)
    {
        if ($property->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function listView()
    {
        $properties = Property::whereHas('status', function ($query) {
            $query->where('id', 'available');
        })->paginate(10);

        return $properties;
    }
}
