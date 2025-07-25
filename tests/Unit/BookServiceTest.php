<?php

namespace Tests\Unit;

use App\DTOs\BookDTO;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use App\Repositories\BookRepository;
use App\Service\BookService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_book_creates_book_and_attaches_authors()
    {
        $author = Author::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $bookDTO = new BookDTO(
            'New Book',
            'Description of new book',
            2024,
            'some-image-url.jpg',
            [$author->id],
            $user->id
        );

        $book = Book::factory()->create([
            'title' => $bookDTO->title,
            'description' => $bookDTO->description,
            'published_year' => $bookDTO->published_year,
            'image' => $bookDTO->image,
            'user_id' => $bookDTO->user_id,
        ]);

        $bookRepositoryMock = $this->createMock(BookRepository::class);

        $bookRepositoryMock->expects($this->once())
            ->method('create')
            ->willReturn($book);

        $bookService = new BookService($bookRepositoryMock);

        $createdBook = $bookService->createBook($bookDTO);

        $this->assertEquals('New Book', $createdBook->title);

        $this->assertDatabaseHas('author_book', [
            'book_id' => $createdBook->id,
            'author_id' => $author->id,
        ]);
    }
}
