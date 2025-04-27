<?php

namespace App\Http\Controllers\Api\Agent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\PropertyStoreRequest;
use App\Http\Requests\Property\PropertyUpdateRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Service\PropertyService;

class PropertyController extends Controller
{
    private $propertyService;

    public function __construct(PropertyService $service)
    {
        $this->propertyService = $service;
    }

    public function index () {

        $properties = $this->propertyService->listUserProperties(auth()->user());

        return response()->json( [
            "result" => PropertyResource::collection($properties),
            "metadata" => [
                "limit" => $properties->perPage(),
                "offset" => ( $properties->currentPage() - 1 ) * $properties->perPage(),
                "total" => $properties->total()
            ]
        ]);

    }

    public function store(PropertyStoreRequest  $request) {

        $property = $this->propertyService->createProperty(auth()->user(), $request->validated());

        return new PropertyResource($property);
    }

    public function show(Property $property)
    {
        $this->propertyService->authorizeProperty(auth()->user(), $property);

        return new PropertyResource($property);
    }

    public function update(PropertyUpdateRequest $request, Property $property) {

        $this->propertyService->authorizeProperty(auth()->user(), $property);

        $property = $this->propertyService->updateProperty($property, $request->validated());

        return new PropertyResource($property);

    }

    public function destroy(Property $property) {

        $this->propertyService->authorizeProperty(auth()->user(), $property);

        $this->propertyService->deleteProperty($property);

        return response()->json(['message' => 'Property deleted successfully']);
    }
}
