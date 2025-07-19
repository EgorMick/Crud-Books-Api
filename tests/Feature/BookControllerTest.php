<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_store_creates_book_and_return_resource(): void
    {

        $user = User::factory()->create();

        $author = Author::factory()->create();

        $book = [
            'title' => 'New Book',
            'description' => 'Some description',
            'published_year' => 2024,
            'image' => 'some-image-url.jpg',
            'authors' => [$author->id],
        ];

        $response = $this->actingAs($user)->postjson('api/books', $book);

        $response->assertStatus(201);

        $response->assertCreated();

//        dd($response->json());

        $response->assertJsonStructure(
            ['data' =>
                ['id',
                'title',
                'description',
                'published_year',
                'image',
                'authors',
                ]
            ]);

        $this->assertDatabaseHas('books', [
            'title' => 'New Book',
        ]);

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
        ]);

    }
}
