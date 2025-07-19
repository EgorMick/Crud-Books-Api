<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Book $book): bool
    {
        if ($book->user_id !== auth()->id()) {
            throw new AuthorizationException('You do not have own to update this book.');
        }

        return true;
    }

    public function delete(User $user, Book $book): bool
    {
        return $book->user_id === auth()->id();
    }
}
