<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyViewResource;
use App\Models\Property;
use App\Service\PropertyService;

class PropertyController extends Controller
{
    private $service;

    public function __construct(PropertyService $service)
    {
        $this->service = $service;
    }

    public function index()
    {

        $properties = $this->service->listView();

        return response()->json([
            "result" => PropertyViewResource::collection($properties),
            "metadata" => [
                "limit" => $properties->perPage(),
                "offset" => ($properties->currentPage() - 1) * $properties->perPage(),
                "total" => $properties->total()
            ]
        ]);
    }

    public function show(Property $property) {

        return new PropertyViewResource($property);
    }
}
