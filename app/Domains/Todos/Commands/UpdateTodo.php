<?php

namespace Todos\Commands;

use Todos\TodoId;
use Todos\TodoRepository;
use Illuminate\Console\Command;

class UpdateTodo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todos:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to update todo';

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

        parent::__construct();
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
