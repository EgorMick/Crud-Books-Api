<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BookCollection',
    description: 'Collection of books',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/BookResource',
                type: 'object',)
        )
    ]
)]
class BookCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => BookResource::collection($this->collection),
        ];
    }
}
