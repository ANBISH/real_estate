<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Property\PropertyStatusRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Service\Admin\PropertyService;

class PropertyController extends Controller
{
    private $service;

    public function __construct(PropertyService $service) {
        $this->service = $service;
    }

    public function index()
    {
        $properties = $this->service->list();

        return response()->json([
            "result" => PropertyResource::collection($properties),
            "metadata" => [
                "limit" => $properties->perPage(),
                "offset" => ( $properties->currentPage() - 1 ) * $properties->perPage(),
                "total" => $properties->total()
            ]
        ]);
    }

    public function updateStatus(PropertyStatusRequest $request,Property $property) {

        $property = $this->service->updateProperty($property, $request->validated());

        return new PropertyResource($property);

    }
}
