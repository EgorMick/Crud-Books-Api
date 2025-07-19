<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BookResource',
    required: ['title', 'image', 'published_year', 'description', 'authors'],
    properties: [
        new OA\Property(property: 'title', type: 'string', example: 'Название книги'),
        new OA\Property(property: 'description', type: 'string', example: 'Описание книги'),
        new OA\Property(property: 'image', type: 'string', example: 'Аватар'),
        new OA\Property(property: 'published_year', type: 'integer', example: 2000),
        new OA\Property(
            property: 'authors',
            type: 'array',
            items: new OA\Items(type: 'integer'),
            example: [1, 2]
        )
    ],
    type: 'object',
)]
class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'title' => $this->title,
                'description' => $this->description,
                'published_year' => $this->published_year,
                'image' => $this->image,
                'authors' => $this->authors->pluck('name')
            ];
    }
}
