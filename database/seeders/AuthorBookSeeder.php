<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = Author::factory(30)->create();
        $books = Book::factory(60)->create();

        $books->each(function ($book) use ($authors) {
            $book->authors()->attach
            (
                $authors->random(rand(1, 4))->pluck('id')
            );
        });
    }
}
