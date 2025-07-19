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
        // Создание автора и пользователя
        $author = Author::factory()->create();
        $user = User::factory()->create();

        // Установка авторизованного пользователя для auth()->id()
        $this->actingAs($user);

        // DTO для создания книги
        $bookDTO = new BookDTO(
            'New Book',
            'Description of new book',
            2024,
            'some-image-url.jpg',
            [$author->id],
            $user->id
        );

        // Сохраняем книгу напрямую через модель, чтобы у неё был ID
        $book = Book::factory()->create([
            'title' => $bookDTO->title,
            'description' => $bookDTO->description,
            'published_year' => $bookDTO->published_year,
            'image' => $bookDTO->image,
            'user_id' => $bookDTO->user_id,
        ]);

        // Мокаем репозиторий
        $bookRepositoryMock = $this->createMock(BookRepository::class);

        // Возвращаем сохранённую книгу
        $bookRepositoryMock->expects($this->once())
            ->method('create')
            ->willReturn($book);

        // Сервис с подставленным мок-репозиторием
        $bookService = new BookService($bookRepositoryMock);

        // Действие
        $createdBook = $bookService->createBook($bookDTO);

        // Проверка: корректно ли создалась книга
        $this->assertEquals('New Book', $createdBook->title);

        // Проверка: были ли привязаны авторы
        $this->assertDatabaseHas('author_book', [
            'book_id' => $createdBook->id,
            'author_id' => $author->id,
        ]);
    }
}
