<?php

declare(strict_types=1);

namespace App\Domains\Todos\Projectors;

use App\EventSource\ProjectorBehaviour;
use Todos\TodoAdded;
use Todos\TodoUpdated;
use EventSauce\EventSourcing\Message;
use EventSauce\LaravelEventSauce\Consumer;
use Illuminate\Contracts\Queue\ShouldQueue;

final class UpdateTodoViewModel extends Consumer implements ShouldQueue, ProjectorBehaviour
{
    // if we implement ShouldQueue, Consumer is queued.

    // ProjectorBehaviour means we can safely replay this during playback
    // Alternative is ReactorBehaviour which means it has side effects and should
    // no be replayed.

    public function handleTodoAdded(TodoAdded $event, Message $message): void
    {
        dump($event);
        dump($message);

        // Create the Eloquent model
    }


    public function handleTodoUpdated(TodoUpdated $event, Message $message): void
    {
        dump($event);
        dump($message);

        // Create the Eloquent model
    }
}
