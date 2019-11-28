<?php

declare(strict_types=1);

namespace Todos;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class TodoAdded implements SerializablePayload
{
    /**
     * @var TodoId
     */
    private $id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var string
     */
    private $todo;

    public function __construct(
        TodoId $id,
        int $user_id,
        string $todo
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->todo = $todo;
    }

    public function id(): TodoId
    {
        return $this->id;
    }

    public function user_id(): int
    {
        return $this->user_id;
    }

    public function todo(): string
    {
        return $this->todo;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new TodoAdded(
            new TodoId($payload['id']),
            (int) $payload['user_id'],
            (string) $payload['todo']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => $this->id,
            'user_id' => (int) $this->user_id,
            'todo' => (string) $this->todo,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndUser_idAndTodo(TodoId $id, int $user_id, string $todo): TodoAdded
    {
        return new TodoAdded(
            $id,
            $user_id,
            $todo
        );
    }
}

final class TodoUpdated implements SerializablePayload
{
    /**
     * @var TodoId
     */
    private $id;

    /**
     * @var string
     */
    private $todo;

    public function __construct(
        TodoId $id,
        string $todo
    ) {
        $this->id = $id;
        $this->todo = $todo;
    }

    public function id(): TodoId
    {
        return $this->id;
    }

    public function todo(): string
    {
        return $this->todo;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new TodoUpdated(
            new TodoId($payload['id']),
            (string) $payload['todo']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => new TodoId($this->id),
            'todo' => (string) $this->todo,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndTodo(TodoId $id, string $todo): TodoUpdated
    {
        return new TodoUpdated(
            $id,
            $todo
        );
    }
}

final class ProcessTodo implements SerializablePayload
{
    /**
     * @var TodoId
     */
    private $id;

    /**
     * @var string
     */
    private $todo;

    public function __construct(
        TodoId $id,
        string $todo
    ) {
        $this->id = $id;
        $this->todo = $todo;
    }

    public function id(): TodoId
    {
        return $this->id;
    }

    public function todo(): string
    {
        return $this->todo;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new ProcessTodo(
            new TodoId($payload['id']),
            (string) $payload['todo']
        );
    }

    public function toPayload(): array
    {
        return [
            'id' => new TodoId($this->id),
            'todo' => (string) $this->todo,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdAndTodo(TodoId $id, string $todo): ProcessTodo
    {
        return new ProcessTodo(
            $id,
            $todo
        );
    }
}
