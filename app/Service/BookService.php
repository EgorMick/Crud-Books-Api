<?php

namespace App\Service;

use App\DTOs\BookDTO;
use App\Events\BookCreated;
use App\Events\BookDeleted;
use App\Events\BookUpdated;
use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class BookService
{
    public function __construct(private BookRepository $bookRepository)
    {
    }

    public function createBook(BookDTO $bookDTO): Book
    {
        $book = $this->bookRepository->create($bookDTO->toArray());

        if (empty($bookDTO->authors)) {
            throw new \Exception('Книга должна иметь хотя бы одного автора!');
        }

        $book->authors()->attach($bookDTO->authors);

        event(new BookCreated($book));

        return $book;
    }


    public function updateBook(Book $book, BookDTO $bookDTO): Book
    {
        $this->bookRepository->update($book, $bookDTO->toArray());

        $book->authors()->sync($bookDTO->authors);

        event(new BookUpdated($book));

        return $book;
    }


    public function deleteBook(Book $book): JsonResponse
    {
        event(new BookDeleted($book));

        $book->delete();

        return response()->json(['message' => 'Книга удалена'], Response::HTTP_OK);
    }
}
