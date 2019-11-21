<?php

declare(strict_types=1);

namespace Todos;

use EventSauce\LaravelEventSauce\AggregateRootRepository;

/** @method \App\Domains\Todos\Todo retrieve(\App\Domains\Todos\TodoId $aggregateRootId) */
final class TodoRepository extends AggregateRootRepository
{
    /** @var string */
    protected static $inputFile = __DIR__ . '/commands_and_events.yml';

    /** @var string */
    protected static $outputFile = __DIR__ . '/commands_and_events.php';

    /** @var string */
    protected $aggregateRoot = Todo::class;

    /** @var string */
    protected $table = 'todo_domain_messages';

    /** @var array */
    protected $consumers = [];
}
