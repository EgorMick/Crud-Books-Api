<?php

namespace App\Http\Requests\Book;

use App\DTOs\BookDTO;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'StoreRequest',
    required: ['title', 'image', 'published_year', 'description', 'authors'],
    properties: [
        new OA\Property(property: 'title', type: 'string', example: 'Название книги'),
        new OA\Property(property: 'image', type: 'string', example: 'Описание книги'),
        new OA\Property(property: 'published_year', type: 'integer', example: 2000),
        new OA\Property(property: 'description', type: 'string', example: 'Аватар'),
        new OA\Property(
            property: 'authors',
            type: 'array',
            items: new OA\Items(type: 'integer'),
            example: [1, 2]
        ),
    ],
    type: 'object',
)]
class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'published_year' => 'required|integer',
            'image' => 'required|string',
            'authors' => 'required|array',
        ];
    }

    public function toDTO(): BookDTO
    {
        return BookDTO::fromArray($this->validated());
    }
}
