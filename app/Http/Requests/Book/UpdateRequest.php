<?php

namespace App\Http\Requests\Book;

use App\DTOs\BookDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'published_year' => 'integer',
            'image' => 'string',
            'authors' => 'array',
        ];
    }

    public function toDTO(): BookDTO
    {
        return BookDTO::fromArray($this->validated());
    }
}
