<?php

namespace App\DTOs;


final class BookDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly int $published_year,
        public readonly string $image,
        public readonly array  $authors = [],
        public ?int $user_id = null
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            published_year: $data['published_year'],
            image: $data['image'],
            authors: $data['authors'] ?? [],
            user_id: $data['user_id'] ?? null
        );
    }

    public function toArray(): array{
        return [
            'title' => $this->title,
            'description' => $this->description,
            'published_year' => $this->published_year,
            'image' => $this->image,
            'authors' => $this->authors,
            'user_id' => $this->user_id
        ];
    }
}
