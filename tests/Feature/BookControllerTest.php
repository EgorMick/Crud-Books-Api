<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var User */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate a user to satisfy user_id requirements
        $this->user = User::factory()->create();
        $this->be($this->user);
    }

    public function testIndexReturnsPaginatedBooks()
    {
        // Create books for the authenticated user
        Book::factory()
            ->count(15)
            ->create(['user_id' => $this->user->id]);

        $response = $this->getJson('/api/books');

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    public function testStoreCreatesBook()
    {
        $author = Author::factory()->create();

        $payload = [
            'title'          => 'Новая книга',
            'description'    => 'Описание новой книги',
            'published_year' => 2024,
            'image'          => 'https://example.com/image.jpg',
            'authors'        => [$author->id],
        ];

        $response = $this->postJson('/api/books', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Новая книга']);

        $this->assertDatabaseHas('books', [
            'title'       => 'Новая книга',
            'description' => 'Описание новой книги',
            'user_id'     => $this->user->id,
        ]);
    }

    public function testShowReturnsBook()
    {
        $book = Book::factory()->create(['user_id' => $this->user->id]);
        $authors = Author::factory()->count(2)->create();
        $book->authors()->attach($authors->pluck('id'));

        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $book->id])
            ->assertJsonCount(2, 'data.authors');
    }

    public function testUpdateModifiesBook()
    {
        $book = Book::factory()->create([
            'user_id'     => $this->user->id,
            'title'       => 'Old Title',
            'description' => 'Old Description',
        ]);
        $newAuthor = Author::factory()->create();

        $payload = [
            'title'          => 'Updated Title',
            'description'    => 'Updated Description',
            'published_year' => 2024,
            'image'          => 'https://example.com/new-image.jpg',
            'authors'        => [$newAuthor->id],
        ];

        $response = $this->patchJson("/api/books/{$book->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Updated Title']);

        $this->assertDatabaseHas('books', [
            'id'          => $book->id,
            'title'       => 'Updated Title',
            'description' => 'Updated Description',
        ]);
    }

    public function testDestroyDeletesBook()
    {
        $book = Book::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
