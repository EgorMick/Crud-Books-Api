<?php

namespace App\Events;

use App\Models\Book;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Book $book)
    {
        //
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
