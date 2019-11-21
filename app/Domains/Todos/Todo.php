<?php

declare(strict_types=1);

namespace Todos;

use Todos\TodoAdded;
use Todos\Commands\AddTodo;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;
use Todos\Commands\UpdateTodo;

final class Todo implements AggregateRoot
{
    use AggregateRootBehaviour;

    private $user_id;
    private $todo;

    public function add(AddTodo $command): void
    {

        // Validate business rules

        $this->recordThat(new TodoAdded(
            $command->todo_id(),
            $command->user_id(),
            $command->todo(),
        ));
    }

    public function applyTodoAdded(TodoAdded $event): void
    {
        $this->user_id = $event->user_id();
        $this->todo = $event->todo();
    }

    public function update(UpdateTodo $command): void
    {

        // Validate business rules

        $this->recordThat(new TodoUpdated(
            $command->todo_id(),
            $command->todo(),
        ));

        dump($this);
    }

    public function applyTodoUpdated(TodoUpdated $event): void
    {
        $this->todo = $event->todo();
    }
}
