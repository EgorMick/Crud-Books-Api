<?php

namespace App\Listeners;

use App\Events\BookCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogBookCreated implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(BookCreated $event): void
    {
        Log::info("Книга создана: {$event->book->title} (ID: {$event->book->id})");
    }
}
