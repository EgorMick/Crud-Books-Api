<?php

namespace App\Listeners;

use App\Events\BookUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogBookUpdated implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(BookUpdated $event): void
    {
        Log::info("Книга обновлена: {$event->book->title} (ID: {$event->book->id})");
    }
}
