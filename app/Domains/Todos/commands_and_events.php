<?php

declare(strict_types=1);

namespace Todos;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class TodoAdded implements SerializablePayload
{
    /**
     * @var TodoId
     */
    private $identifier;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @var string
     */
    private $todo;

    public function __construct(
        TodoId $identifier,
        int $user_id,
        string $todo
    ) {
        $this->identifier = $identifier;
        $this->user_id = $user_id;
        $this->todo = $todo;
    }

    public function identifier(): TodoId
    {
        return $this->identifier;
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
            new TodoId($payload['identifier']),
            (int) $payload['user_id'],
            (string) $payload['todo']
        );
    }

    public function toPayload(): array
    {
        return [
            'identifier' => $this->identifier->toString(),
            'user_id' => (int) $this->user_id,
            'todo' => (string) $this->todo,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdentifierAndUser_idAndTodo(TodoId $identifier, int $user_id, string $todo): TodoAdded
    {
        return new TodoAdded(
            $identifier,
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
    private $identifier;

    /**
     * @var string
     */
    private $todo;

    public function __construct(
        TodoId $identifier,
        string $todo
    ) {
        $this->identifier = $identifier;
        $this->todo = $todo;
    }

    public function identifier(): TodoId
    {
        return $this->identifier;
    }

    public function todo(): string
    {
        return $this->todo;
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new TodoUpdated(
            new TodoId($payload['identifier']),
            (string) $payload['todo']
        );
    }

    public function toPayload(): array
    {
        return [
            'identifier' => $this->identifier->toString(),
            'todo' => (string) $this->todo,
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    public static function withIdentifierAndTodo(TodoId $identifier, string $todo): TodoUpdated
    {
        return new TodoUpdated(
            $identifier,
            $todo
        );
    }
}
