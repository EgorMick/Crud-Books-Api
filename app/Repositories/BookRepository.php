<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookRepository
{
    public function create(array $book): Book
    {
        return
            DB::transaction(function () use ($book) {
                return Book::create([
                    'title' => $book['title'],
                    'description' => $book['description'],
                    'published_year' => $book['published_year'],
                    'image' => $book['image'],
                    'user_id' => auth()->id(),
                ]);
            });
    }

    public function update($book, array $bookDTO): Book
    {
        $book->update([
            'title' => $bookDTO['title'],
            'description' => $bookDTO['description'],
            'published_year' => $bookDTO['published_year'],
            'image' => $bookDTO['image'],
        ]);

        return $book;
    }
}
