<?php

namespace App\Listeners;

use App\Events\BookDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogBookDeleted
{
    public function __construct()
    {
        //
    }

    public function handle(BookDeleted $event): void
    {
            Log::info("Книга удалена: {$event->book->title} (ID: {$event->book->id})");
    }
}
