<?php

namespace Todos\Commands;

use Todos\TodoId;
use Todos\TodoRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateTodo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var TodoId
     */
    protected $todo_id;

    /**
     * @var string
     */
    protected $todo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TodoId $todo_id, string $todo)
    {
        $this->todo_id = $todo_id;
        $this->todo = $todo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(TodoRepository $repository): void
    {
        // Get the Todo Aggregate Root
        $todo = $repository->retrieve($this->todo_id);

        // Check if AR exists
        if ($todo->aggregateRootVersion() == 0) {
            throw new ModelNotFoundException();
        }

        try {
            // Call update on AR
            $todo->update($this);
        } finally {
            $repository->persist($todo);
        }
    }

    public function todo_id(): TodoId
    {
        return $this->todo_id;
    }

    public function todo(): string
    {
        return $this->todo;
    }
}
